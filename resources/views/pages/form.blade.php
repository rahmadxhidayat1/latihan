@extends('layouts.dashboard')
@section('content2')
<form action="{{ route('student.store')}}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" id="exampleInputEmail1" >
      @error('name') <div class="text-muted">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail2" class="form-label">Date Birth</label>
        <input type="date" class="form-control" name="date_birth" id="exampleInputEmail2">
        @error('date_birth') <div class="text-muted">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail3" class="form-label">Gender</label>
        <select class="form-control" name="gender" id="">
            <option value="man">man</option>
            <option value="woman">woman</option>
        </select>
        @error('gender') <div class="text-muted">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail4" class="form-label">Address</label>
        <textarea name="address" id="" cols="40" rows="5" class="form-control"></textarea>
        @error('address') <div class="text-muted">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail5" class="form-label">Major</label>
        <select name="major" class="form-control" id="">
            <option value="informatika">informatika</option>
            <option value="matematika">matematika</option>
            <option value="designer">designer</option>
        </select>
        @error('major') <div class="text-muted">{{$message}}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection()
