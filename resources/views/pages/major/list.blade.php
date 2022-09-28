@extends('layouts.dashboard')
@section('content2')
<a href="/major/create"><button class="btn-info mb-2">Input</button></a>
@if($message = Session::get('notif'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{$message}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
<table class="table table-primary table-condensed text-center">
    <thead>
      <tr>
        <th>#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Menu</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr class="text-start">
                <th class="table-active text-break">{{$loop->iteration}}</th>
                <td class="table-danger">{{$item->name}}</td>
                <td class="table-secondary bg-gradient " >{{$item->description}}</td>
                <td class="table-warning">
                    <a href="{{ route('major.edit', ['major' =>$item->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{route('major.destroy', ['major' =>$item->id]) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-warning">delete</button>
                    </form>
                    <a href="{{ route('major.show', ['major' =>$item->id]) }}" class="btn btn-primary">Student</a>
                </td>
            </tr>
        @endforeach
      <tr>

      </tr>
    </tbody>
  </table>
@endsection()
