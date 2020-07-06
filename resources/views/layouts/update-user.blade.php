@extends('master')
@section('title','Update user')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update user</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('make-user-update',$user->id)}}" method="POST">
        @method('PATCH')
        @csrf
        @if (count($errors)>0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    {{$err}}
                @endforeach
            </div>
            @endif
        @if(Session::has('Update-User'))
                <div class="alert alert-success">{{Session::get('Update-User')}}</div>
        @endif
        @if(Session::has('Fail-Update-User'))
                <div class="alert alert-danger">{{Session::get('Fail-Update-User')}}</div>
        @endif
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">User name</label>
          <input type="text" class="form-control" name="name" value="{{$user->name}}" id="name" placeholder=" user name">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Email</label>
          <input type="text" class="form-control" name="email" value="{{$user->email}}" id="email" placeholder="email">
          <div id="validate"></div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

    </form>
</div>
<script>
    $(document).ready(function(){
     $('#email').keyup(function(){
            var email = $(this).val();
            if(email != '')
            {
             var _token = $('input[name="_token"]').val();
             $.ajax({
              url:"{{ route('validate-location') }}",
              method:"POST",
              data:{email:email, _token:_token},
              success:function(data){
                  setTimeout(function(){
                    $('#validate').fadeIn();
                    $('#validate').html(data);
                  },1000);
              }
             });
            }else{
                $('#validate').html('<label style="color:red">email cant empty</label>');
            }

        });
    });
</script>
@endsection

