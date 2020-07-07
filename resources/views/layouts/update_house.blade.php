@extends('master')
@section('title','Update house')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update house</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('Edit-House',$house->id)}}" id="form_submit" method="POST" enctype="multipart/form-data">
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
          <input type="text" class="form-control" name="house_name" value="{{$house->house_name}}" id="house_name" placeholder="House name">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">House type</label>
          <input type="text" class="form-control" name="house_type" value="{{$house->house_type}}" id="house_type" placeholder="House Type">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">House details</label>
            <input type="text" class="form-control"name="house_details" value="{{$house->house_details}}" id="house_details" placeholder="House details">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" class="form-control" name="house_address" value="{{$house->house_address}}" id="house_address" placeholder="House Address">
        </div>
        <div class="form-group">
            <label>Location</label>
            <select class="form-control" name="location_name" id="location_name">
                @foreach ($location as $locate)
                @if ($locate->disable != 1)
                <option name="{{$locate->id}}" id="{{$locate->id}}">{{$locate->location_name}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
                <div>
                    <input type="file" name="image">
                 </div>
            </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

    </form>

</div>

@endsection

