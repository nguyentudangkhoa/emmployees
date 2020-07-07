@extends('master')
@section('title','Admin-Table')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Simple Tables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Simple Tables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">House Table</h3>
              @if(Session::has('Delete-House'))
              <script type="text/javascript"> alert('Delete house successfully');
              </script>
                @endif
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown row"style="margin-left:0px">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="{{route('simple','Name=asc')}}">Tăng theo tên</a></li>
                  <li><a href="{{route('simple','Name=desc')}}">Giảm theo tên</a></li>
                  <li><a href="{{route('simple','Id=asc')}}">Tăng theo ID</a></li>
                  <li><a href="{{route('simple','Id=desc')}}">Giảm theo ID</a></li>
                  <li><a href="{{route('simple','Created_at=asc')}}">Tăng theo ngày đăng</a></li>
                  <li><a href="{{route('simple','Created_at=desc')}}">Giảm theo ngày đăng</a></li>
                  <li><a href="{{route('simple','Updated_at=asc')}}">Tăng theo ngày update</a></li>
                  <li><a href="{{route('simple','Updated_at=desc')}}">Giảm theo ngày update</a></li>
                </ul>
                <form action="{{route('add-house')}}" method="get" style="margin-left: 5px">
                    <button type="submit" class="btn btn-primary">Add a house</button>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table id="example2" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Details</th>
                    <th>Address</th>
                    <th>Location image</th>
                    <th>Location</th>
                    <th>status</th>
                    <th>Create at</th>
                    <th>Update at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($array as $value)
                  <tr id="house{{$value->id}}">
                    <td>{{$value->id}}</td>
                    <td>{{$value->house_name}}</td>
                    <td>{{$value->house_type}}</td>
                    <td>{{$value->house_details}}</td>
                    <td>{{$value->house_address}}</td>
                    <td><img src="images/{{$value->house_image}}" style="width: 80px; height:50px" alt=""></td>
                    <td>{{$value->location_name}}</td>
                    @if($value->disable == 1)
                    <td><p id="status-house{{ $value->id }}">Sold</p></td>
                    @else
                    <td><p id="status-house{{ $value->id }}"></p></td>
                    @endif
                    <td>{{$value->create_at}}</td>
                    <td>{{$value->update_at}}</td>
                    <td>
                        <div class="btn-group">
                            @if($value->disable != 1)
                            <input type="submit" id="dis-house{{ $value->id }}" class="del-house-form btn btn-danger" data-idhouse="{{$value->id}}" value="Delete" data-toggle="modal" data-target="#modal-house">
                            <input type="submit" id="en-house{{ $value->id }}" data-message="Do you wan to enable this house" class="en-house btn btn-success" data-idhouse="{{$value->id}}" data-token="{{ csrf_token() }}" value="Enable" style="display: none">
                            @else
                            <input type="submit" id="dis-house{{ $value->id }}" class="del-house-form btn btn-danger" data-idhouse="{{$value->id}}" value="Delete" data-toggle="modal" data-target="#modal-house" style="display: none">
                            <input type="submit" id="en-house{{ $value->id }}" data-message="Do you wan to enable this house" class="en-house btn btn-success" data-idhouse="{{$value->id}}" data-token="{{ csrf_token() }}" value="Enable">
                            @endif
                            <form action="{{route('House-edit',$value->id)}}" method="get">
                                <input type="submit" class="btn btn-info" value="Update">
                            </form>
                          </div>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            <div class="row">{{$house_product->links()}}</div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

      <div class="modal fade" id="modal-house">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Approve</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_house" value="">
              <p>Are you sure to disable this house&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="del-house" data-message="Do you want to disable this house ?" class="btn btn-primary" data-token="{{ csrf_token() }}">Confirm</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Location Table</h3>
              @if(Session::has('report-Delete-Location'))
              <script type="text/javascript"> alert('Delete location successfully');
              </script>
                @endif
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown row"style="margin-left:0px">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="{{route('simple','NameOfLocation=asc')}}">Tăng theo tên</a></li>
                  <li><a href="{{route('simple','NameOfLocation=desc')}}">Giảm theo tên</a></li>
                  <li><a href="{{route('simple','IdOfLocation=asc')}}">tăng theo ID</a></li>
                  <li><a href="{{route('simple','IdOfLocation=desc')}}">Giảm theo ID</a></li>
                </ul>
                <form action="{{route('add-location')}}" method="get" style="margin-left: 5px">
                    <button type="submit" class="btn btn-primary">Add a Location</button>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 100%;">
              <table id="example1" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>City</th>
                    <th>status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($Location as $lo_item)
                  <tr id="local{{ $lo_item->id }}">
                    <td>{{$lo_item->id}}</td>
                    <td>{{$lo_item->location_name}}</td>
                    @if ($lo_item->parent_id == 2)
                        <td>TP.Hồ Chí Minh</td>
                    @else
                        <td>Chưa có bảng parent</td>
                    @endif
                    @if($lo_item->disable != 1)
                    <td><p id="status-location{{ $lo_item->id }}"></p></td>
                    @else
                    <td><p id="status-location{{ $lo_item->id }}">Disable</p></td>
                    @endif
                    <td>
                        {{-- action="{{route('delete-Location',$lo_item->id)}}" --}}
                        <div class="btn-group">
                            @if($lo_item->disable != 1)
                            <button type="submit" id="dis-location{{$lo_item->id}}" class="btnDis btn btn-danger" data-idloca="{{ $lo_item->id }}" data-toggle="modal" data-target="#modal-sm">Delete</button>
                            <input type="submit" id="en-location{{$lo_item->id}}" data-message="Do you wan to enable this location" class="en-location btn btn-success" data-idloca="{{ $lo_item->id}}" data-token="{{ csrf_token() }}" value="Enable" style="display: none">
                            @else
                            <input type="submit" id="en-location{{$lo_item->id}}" data-message="Do you wan to enable this location" class="en-location btn btn-success" data-idloca="{{ $lo_item->id}}" data-token="{{ csrf_token() }}" value="Enable" >
                            <button type="submit" id="dis-location{{$lo_item->id}}" class="btnDis btn btn-danger" data-idloca="{{ $lo_item->id }}" data-toggle="modal" data-target="#modal-sm" style="display: none">Delete</button>
                            @endif
                            <form action="{{route('update-location',$lo_item->id)}}" method="get">
                                <button type="submit" class="btn btn-info">update</button>
                            </form>
                        </div>

                    </td>
                   </tr>
                @endforeach
                </tbody>
              </table>
              <div class="row">{{$Location->links()}}</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Approve</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idlocal" value="">
              <p>Are you sure to disable this location&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="dislocation" class="btn btn-primary" data-message="Do you want to disable this location ?" data-idlocal="" data-urf="" data-token="{{ csrf_token() }}">Confirm</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">User Table</h3>
                @if(Session::has('Fail-Delete-User'))
                    <script type="text/javascript"> alert('fail to delete user because user is used');
                    </script>
                @endif
                @if(Session::has('Delete-User'))
                <script type="text/javascript"> alert('Delete users successfully');
                </script>
                @endif
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="{{route('simple','NameOfUser=asc')}}">Tăng theo tên</a></li>
                  <li><a href="{{route('simple','NameOfUser=desc')}}">Giảm theo tên</a></li>
                  <li><a href="{{route('simple','IdOfUser=asc')}}">Tăng theo ID</a></li>
                  <li><a href="{{route('simple','IdOfUser=desc')}}">Giảm theo ID</a></li>
                  <li><a href="{{route('simple','Created_user_at=asc')}}">Tăng theo ngày đăng ký</a></li>
                  <li><a href="{{route('simple','Created_user_at=desc')}}">Giảm theo ngày đăng ký</a></li>
                  <li><a href="{{route('simple','Updated_user_at=asc')}}">Tăng theo ngày update</a></li>
                  <li><a href="{{route('simple','Updated_user_at=desc')}}">Giảm theo ngày update</a></li>
                  <li><a href="{{route('simple','Login_user_at=asc')}}">Tăng theo ngày đăng nhập</a></li>
                  <li><a href="{{route('simple','Login_user_at=desc')}}">Giảm theo ngày đăng nhập</a></li>
                  <li><a href="{{route('simple','Logout_user_at=asc')}}">Tăng theo ngày đăng xuất</a></li>
                  <li><a href="{{route('simple','Logout_user_at=desc')}}">Giảm theo ngày đăng xuất</a></li>
                </ul>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 100%;">
              <table id="example3" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>role</th>
                    <th>Status</th>
                    <th>Create at</th>
                    <th>Update at</th>
                    <th>Log In at</th>
                    <th>Log Out at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($User as $user_item)
                  <tr>
                    <td>{{$user_item->id}}</td>
                    <td>{{$user_item->name}}</td>
                    <td>{{$user_item->email}}</td>
                    <td>{{ $user_item->role }}</td>
                    @if ($user_item->disable == 0)
                        <td><p id="status-user{{ $user_item->id }}"></p></td>
                    @else
                        <td><p id="status-user{{ $user_item->id }}">Disable</p></td>
                    @endif
                    <td>{{$user_item->created_at}}</td>
                    <td>{{$user_item->updated_at}}</td>
                    <td>{{$user_item->login_at}}</td>
                    <td>{{$user_item->logout_at}}</td>
                    <td>
                        <div class="btn-group">
                            @if($user_item->disable == 0)
                            <button type="submit" id="dis-user{{$user_item->id}}" data-message="Do you want to disable this account ?" class="btn-dis-user btn btn-danger" data-iduser="{{ $user_item->id }}" data-token="{{ csrf_token() }}">Delete</button>
                            <input type="submit" id="en-user{{$user_item->id}}" data-message="Do you wan to enable this user?" class="en-user btn btn-success" data-idloca="{{$user_item->id}}" data-token="{{ csrf_token() }}" value="Enable" style="display: none">
                            @else
                            <button type="submit" id="dis-user{{$user_item->id}}" data-message="Do you want to disable this account ?" class="btn-dis-user btn btn-danger" data-iduser="{{ $user_item->id }}" data-token="{{ csrf_token() }}" style="display: none">Delete</button>
                            <input type="submit" id="en-user{{$user_item->id}}" data-message="Do you wan to enable this user?" class="en-user btn btn-success" data-idloca="{{$user_item->id}}" data-token="{{ csrf_token() }}" value="Enable">
                            @endif
                            <form action="{{route('user-update',$user_item->id)}}" method="get">
                                <button type="submit" class="btn btn-info">update</button>
                            </form>
                        </div>
                    </td>
                   </tr>
                @endforeach
                </tbody>
              </table>
              <div class="row">{{$User->links()}}</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false,
        "paginate":false,
      });
      $("#example3").DataTable({
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false,
        "paginate":false,
      });
      $('#example2').DataTable({
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false,
        "paginate":false,
      });
    });
  </script>
@endsection
