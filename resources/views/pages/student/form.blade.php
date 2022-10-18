@extends('layouts.dashboard')
@section('content2')
<h1>{{ $student->id ? 'Edit' : 'Create'}}</h1>
@if ($student->id)
    <form action="{{ route('student.update' , ['student' => $student->id])}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{ route('student.store')}}" method="POST" enctype="multipart/form-data" >
@endif
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" value="{{$student ->name}}" id="exampleInputEmail1" >
      @error('name') <div class="text-muted">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail2" class="form-label">Date Birth</label>
        <input type="date" class="form-control" name="date_birth" value="{{$student ->date_birth}}" id="exampleInputEmail2">
        @error('date_birth') <div class="text-muted">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail3" class="form-label">Gender</label>
        <select class="form-control" name="gender" id="">
            <option value="male" {{$student->gender == 'male' ? 'selected' : ''}}>male</option>
            <option value="female" {{$student->gender == 'female' ? 'selected' : ''}}>female</option>
        </select>
        @error('gender') <div class="text-muted">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail4" class="form-label">Address</label>
        <textarea name="address" id="" cols="40" rows="5" class="form-control">{{$student ->address}}</textarea>
        @error('address') <div class="text-muted">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail5" class="form-label">Major</label>
        <select name="major_id" class="form-control" id="">
            @foreach ($majors as $major )
                <option value="{{ $major ->id}}">{{$major->name}}</option>
            @endforeach()
        </select>
        @error('major') <div class="text-muted">{{$message}}</div>
        @enderror
    </div>
    <label for="inputPassword5" class="form-label">Password</label>
    <input type="file" name="image" id="image" class="form-control">
    <div id="passwordHelpBlock" class="form-text">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection()
