<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->date('date_birth', 25);
            $table->enum('gender',['man','woman']);
            $table->text('address');
            $table->string('major')->nullable();
            $table->integer('major_id');
            $table->timestamps();//kolo m created_at, updated_at

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
}
