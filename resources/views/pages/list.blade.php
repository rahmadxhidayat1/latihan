@extends('layouts.dashboard')
@section('content2')
<a href="/student/create"><button class="btn-info mb-2">Input</button></a>
<table class="table table-primary table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th scope="col">Name</th>
        <th scope="col">Date Birth</th>
        <th scope="col">Gender</th>
        <th scope="col">Address</th>
        <th scope="col">Major</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <th>{{$loop->iteration}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->date_birth}}</td>
                <td>{{$item->gender}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->major}}</td>
            </tr>
        @endforeach
      <tr>

      </tr>
    </tbody>
  </table>
@endsection()
