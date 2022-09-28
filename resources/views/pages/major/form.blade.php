@extends('layouts.dashboard')
@section('content2')
<h1>{{ $major->id ? 'Edit' : 'Create'}}</h1>
@if ($major->id)
    <form action="{{ route('major.update' , ['major' => $major->id])}}" method="POST">
    @method('PUT')
@else
    <form action="{{ route('major.store')}}" method="POST">
@endif
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Major</label>
      <input type="text" class="form-control" name="name" value="{{$major ->name}}" id="exampleInputEmail1" >
      @error('name') <div class="text-muted">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" value="{{$major ->description}}" id="exampleInputEmail1" >
        @error('description') <div class="text-muted">{{$message}}</div>
        @enderror
        <button type="submit" class="p-2 btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
@endsection()
