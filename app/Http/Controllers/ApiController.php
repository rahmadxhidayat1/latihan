<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use PHPUnit\Framework\MockObject\Builder\Stub;

class ApiController extends Controller
{
    public function list(Request $request){
        $limit = $request->input('limit');
        return Transaction::with(['details'])->paginate($limit);
    }
    public function detail(Request $request, $id)
    {
        //cara pertama
        //return Transaction::find($id);

        //cara dua
        return Transaction::where('id', $id)->with(['details'])->first();
    }
    public function store(Request $request)
    {
        $params = $request->all();
        //cara ngambil idnya pake laravel collection
        $productIds = collect($params['products']);
        $productIds = $productIds->pluck('id');

        //cara ambil idnya pake manual
        $productIds = [];
        $total_amount = 0;
        foreach ($params['products'] as $value){
            $productIds[] =$value['id'];
        }

        //hasil dari ambil idnya adalah [1,2,3]

        $products = Product::whereIn('id', $productIds)->get();
        //whereIn untuk select semua id dalam array sebenarnya bisa menggunakan(php native) select * where id in [1,2,3,...,100] tapi terlalu banyak
        //hasil dari whereIn('id', $productIds)->get()
        /*
        $products = [
            {
                id:1,
                price:2,
                name:x
            }
            {
                id:2,
                price:x,
                name:x
            }
        ]
        */

        $total_amount = 0;
        foreach ($params['products'] as $value){
            $product = $products->firstWhere('id', $value['id']);
            $total_amount += ($product ? $product->price : 0) * $value['qty'];
        }

        DB::beginTransaction();
        try {
            $transaction= Transaction::create([
                'id' => Uuid::uuid4()->toString(),
                'customer' => $params['customer_name'],
                'total_amount'=> $total_amount
            ]);

            $transaction_details = [];
            foreach ($params['products'] as $key => $value){
                $product = $products->firstWhere('id', $value['id']);
                $transaction_details[]= [
                    'id' => Uuid::uuid4()->toString(),
                    'transaction_id' =>$transaction->id,
                    'product_id' => $value['id'],
                    'quantity' =>$value['qty'],
                    'amount' => $product ? $product->price : 0,
                    'created_at' => Carbon::now()
                ];
            }
            if ($transaction_details){
                TransactionDetail::insert($transaction_details);
            }
            DB::commit();
            return $transaction;
        }catch(\Throwable $th){
            DB::rollback();
            return $th;
        }
    }
}
