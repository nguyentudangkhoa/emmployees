@extends('master')
@section('title','Add house')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add a house</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('add-house-now')}}" method="POST" enctype="multipart/form-data">
        @if (count($errors)>0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    {{$err}}
                @endforeach
            </div>
            @endif
        @if(Session::has('reportUpdate'))
                <div class="alert alert-success">{{Session::get('reportUpdate')}}</div>
            @endif
        <input type="hidden" name="_token" value={{ csrf_token() }} >
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">House name</label>
          <input type="text" class="form-control" name="house_name" id="house_name" placeholder="House name">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">House type</label>
          <input type="text" class="form-control" name="house_type" id="house_type" placeholder="House Type">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">House details</label>
            <input type="text" class="form-control"name="house_details" id="house_details" placeholder="House details">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" class="form-control" name="house_address" id="house_address" placeholder="House Address">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
                <div>
                    <input type="file" name="image">
                 </div>
            </div>
        </div>
        <div class="form-group">
            <label>Location</label>
            <select class="form-control" name="location_name" id="location_name">
                @foreach ($location as $locate)
                <option name="{{$locate->id}}" id="{{$locate->id}}">{{$locate->location_name}}</option>
                @endforeach
            </select>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
@endsection

