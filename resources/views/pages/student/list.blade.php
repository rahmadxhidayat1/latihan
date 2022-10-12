@extends('layouts.dashboard')
@section('content2')
@if($message = Session::get('notif'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<a href="/student/create"><button style="width: 25%" class="btn text-start btn-outline-primary border-2 mb-2">Input</button></a>
  <form class="row" action="{{route('student.index')}}" method="get">
    <div>
        <select name="filter" id="filter" class="form-select" style="width: 25%" name="major" id="">
            @foreach ($majors as $major )
            <option value="{{$major->id}}" {{request('filter') == $major->id ? 'selected' : '' }}>
                {{$major->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="pt-2">
      {{-- <label for="exampleInputEmail1" class="form-label">Pencarian</label> --}}
      <input type="text" placeholder="Pencarian" style="width: 25%" name="search" value="{{ request('search')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="pt-2 mb-2">
        <div type="submit" class="btn btn-primary">Submit</div>
    </div>
  </form>
<table class="table bg-warning bg-opacity-75 table-bordered border-dark">
    <thead class="text-start">
      <tr>
        <th>#</th>
        <th scope="col">Name</th>
        <th scope="col">Date Birth</th>
        <th scope="col">Gender</th>
        <th scope="col">Address</th>
        <th scope="col">Major</th>
        <th scope="col">Menu</th>
      </tr>
    </thead>
    <tbody class="text-start">
        @foreach ($data as $item)
            <tr>
                <th scope="row" style="color: rgb(255, 248, 10)" class="">{{($data->currentPage()-1)* $data->perPage() + $loop->iteration}}</th>
                <td class="table-danger">{{$item->name}}</td>
                <td class="table-warning">{{$item->date_birth}}</td>
                <td class="table-danger">{{$item->gender}}</td>
                <td class="table-warning">{{$item->address}}</td>
                <td class="table-danger" >{{$item->major->name}}</td>
                <td class="table-warning">
                    <a href="{{ route('student.edit', ['student' =>$item->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{route('student.destroy', ['student' =>$item->id]) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-warning">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
      <tr>

      </tr>
    </tbody>
  </table>
{{ $data->withQueryString()->links()}}
@endsection()
