@extends('master')
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Admin Page</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-3">

                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                          @if (Auth::user()->avatar != '')
                          <img class="profile-user-img img-fluid img-circle"
                             src="dist/img/{{Auth::user()->avatar}}"
                             alt="User profile picture">
                          @else
                          <img class="profile-user-img img-fluid img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture">
                          @endif

                      </div>

                      <h3 class="profile-username text-center" id="txtUser-name">{{Auth::user()->name}}</h3>

                      <p class="text-muted text-center">{{Auth::user()->position}}</p>

                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>ID</b> <a class="float-right" id="txtId">{{Auth::user()->id}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Address</b> <a class="float-right" id="txtAddress">{{Auth::user()->address}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Total day off </b> <a class="float-right" id="txtHoliday">{{Auth::user()->total_holidays}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Gender </b> <a class="float-right" id="txtGender">{{Auth::user()->gender}}</a>
                        </li>
                      </ul>
                      @if(Session::has('Update-Avatar'))
                            <script>Change avatar success</script>
                      @endif
                      <button id="toggle-btn" class="toggel-btn-ready  btn btn-primary btn-block"><b>Change Avatar</b></button>
                      <form action="{{route('edit-avatar')}}" method="POST" class="form-avatar" enctype="multipart/form-data" style="display: none; margin-top 10px">
                          @method('PUT')
                          @csrf

                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="image" id="exampleInputFile" required>
                              <label class="custom-file-label" id='label-img' for="exampleInputFile">Choose File</label>
                            </div>
                        </div>
                          <input type="submit" class="btn btn-primary btn-block" value="Submit">
                      </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                  <!-- About Me Box -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <strong><i class="fas fa-book mr-1"></i> University</strong>

                      <p class="text-muted" id="txtUniversity">
                        {{Auth::user()->university}}
                      </p>

                      <hr>

                      <strong><i class="fas fa-book mr-1"></i> Granduate year</strong>

                      <p class="text-muted" id="txtGranduate-year">
                        {{Auth::user()->granduate_year}}
                      </p>

                      <hr>

                      <strong><i class="fas fa-envelope"></i> Email</strong>

                      <p class="text-muted" id="txtEmail">{{Auth::user()->email}}</p>

                      <hr>

                      <strong><i class="fas fa-pencil-alt mr-1" ></i> Identity card</strong>

                      <p class="text-muted" id="txtId-card">
                        {{Auth::user()->identity_card}}
                      </p>

                      <hr>

                      <strong><i class="fas fa-pencil-alt mr-1"></i> Issue date</strong>

                      <p class="text-muted" id="txtIssue-date">
                        {{Auth::user()->issue_date}}
                      </p>

                      <hr>

                      <strong><i class="fas fa-pencil-alt mr-1"></i> Issue place</strong>

                      <p class="text-muted" id="txtIssue-place">
                        {{Auth::user()->issue_place}}
                      </p>

                      <hr>

                      <strong><i class="fas fa-pencil-alt mr-1"></i> Birthday</strong>

                      <p class="text-muted" id="txtBirthday">
                        {{Auth::user()->birthday}}
                      </p>

                      <hr>

                      <strong><i class="fas fa-pencil-alt mr-1"></i> Role</strong>

                      <p class="text-muted" id="txtRole">
                        {{Auth::user()->role}}
                      </p>

                      <hr>


                      <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                      <p class="text-muted" id="txtNote"> {{Auth::user()->note}} </p>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Approve absence Letter</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="#letter" data-toggle="tab">Create Absence Letter</a></li>
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="timeline">
                          <!-- The timeline -->
                          <div class="">
                            <!-- timeline time label -->
                            <div class="row">
                                <div class="col-12" style="text-align:center">
                                  <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Absence letter</h3>
                                      </div>

                            <div class="card-body table-responsive p-0" style="height: 100%;">
                                <table id="example3" class="table table-hover text-nowrap">
                                  <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Employee name</th>
                                      <th>Reason</th>
                                      <th>From date</th>
                                      <th>To date</th>
                                      <th>Status</th>
                                      <th>Reason dissapprove</th>
                                      <th>Created at</th>
                                      <th>Updated at</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach ($letter_form as $user_item)
                                    <form action="" class="form-{{$user_item->id}}" method="post">
                                        <tr>
                                        <td>{{$user_item->id}}</td>
                                        <td>{{$user_item->user_name}}</td>
                                        <td>{{$user_item->reason}}</td>
                                        <td>{{$user_item->from_date}}</td>
                                        <td>{{$user_item->to_date}}</td>
                                        <td><p class="tr-{{$user_item->id}}">{{$user_item->status}}</p></td>
                                        <td><p class="tr-reason-{{$user_item->id}}">{{$user_item->reason_disapprove}}</p></td>
                                        <td>{{$user_item->created_at}}</td>
                                        <td>{{$user_item->updated_at}}</td>
                                        <td><div class="btn-group">
                                            @if($user_item->status != "approved" && $user_item->status != "reject")
                                            <button type="submit" data-id={{$user_item->id}} id="approve-{{$user_item->id}}" class="approve btn btn-danger" data-toggle="modal" data-target="#modal-sm">Approve</button>
                                            <button type="submit" data-id={{$user_item->id}} id="dissapprove-{{$user_item->id}}" class="dissapprove btn btn-info" data-toggle="modal" data-target="#modal-lg">Dissapprove</button>
                                            @elseif($user_item->status == "approved" || $user_item->status == "reject")
                                            <button type="submit" data-id={{$user_item->id}} id="approve-{{$user_item->id}}" class="approve btn btn-danger" data-toggle="modal" data-target="#modal-sm" disabled>Approve</button>
                                            <button type="submit" data-id={{$user_item->id}} id="dissapprove-{{$user_item->id}}" class="dissapprove btn btn-info" data-toggle="modal" data-target="#modal-lg" disabled>Dissapprove</button>
                                            @endif
                                            </div>
                                        </td>
                                        </tr>
                                    </form>
                                  @endforeach
                                  </tbody>
                                </table>
                              </div>

                            <!-- END timeline item -->
                          </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                        <!-- /.tab-pane -->


<!---->
<!-- /.modal -->

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reason</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <textarea class="form-control inputReason" name="reason" id="inputReason" placeholder="Reason"></textarea>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="saveChange" class="btn btn-primary" data-urf="{{route('dissapprove')}}" data-token="{{ csrf_token() }}">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- /.modal -->

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
          <p>Are you sure&hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="confirm_approve" class="btn btn-primary" data-urf="{{route('approve')}}" data-token="{{ csrf_token() }}">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!---->



                        <div class="tab-pane" id="settings">
                          <form class="form-horizontal" id="form_settings" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_member" id="id_member" value="{{Auth::user()->id}}">
                            <div class="form-group row">
                              <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="inputName" value="{{Auth::user()->name}}" placeholder="Name" required>
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="email" id="inputEmail" value="{{Auth::user()->email}}" placeholder="Email" required>
                                </div>
                              </div>
                            <div class="form-group row">
                              <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" id="inputAddress"value="{{Auth::user()->address}}" placeholder="Address" required>
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputIDCard" class="col-sm-2 col-form-label">Identity card</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="identity_card" id="inputIDCard" value="{{Auth::user()->identity_card}}" placeholder="Identity card" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputIssuePlace" class="col-sm-2 col-form-label">Issue place</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="issue_place" id="inputIssuePlace" value="{{Auth::user()->issue_place}}" placeholder="Issue place" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputIssueDate" class="col-sm-2 col-form-label">Issue date</label>
                                <div class="col-sm-10">
                                  <input type="date" class="form-control" name="issue_date" id="inputIssueDate" value="{{Auth::user()->issue_date}}" placeholder="Issue date" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputUniersity" class="col-sm-2 col-form-label">University</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="university" id="inputUniversity" value="{{Auth::user()->university}}" placeholder="University" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputGrandudateYear" class="col-sm-2 col-form-label">Granduate year</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="granduate_year" id="inputGrandudateYear">
                                        @for ($i = 1910; $i < 2099; $i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputStartJobAt" class="col-sm-2 col-form-label">Start job at</label>
                                <div class="col-sm-10">
                                  <input type="datetime-local" class="form-control" name="start_job_at" id="inputStartJobAt" placeholder="Start job at" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputBirthday" class="col-sm-2 col-form-label">Birthday</label>
                                <div class="col-sm-10">
                                  <input type="date" class="form-control" name="birthday" id="inputBirthday" placeholder="Birthday" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="gender" id="inputGender">
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Another</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputNote" class="col-sm-2 col-form-label">Note</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" name="note" id="inputNote" placeholder="Note" required> {{Auth::user()->note}}</textarea>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <button type="submit" id="submit_setting" class="btn btn-danger">Submit</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!-- /.tab-pane -->
                        <!--Letter absence-->
                        <div class="tab-pane" id="letter">
                            <form class="form-horizontal"  id="setting-letter"  method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_member" id="id" value="{{Auth::user()->id}}">
                              <div class="form-group row">
                                <label for="inputFrom" class="col-sm-2 col-form-label">From</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="from_date" id="inputFrom" placeholder="From" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputTo" class="col-sm-2 col-form-label">To</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="to_date" id="inputTo" placeholder="To" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputReason" class="col-sm-2 col-form-label">Reason</label>
                                <div class="col-sm-10">
                                  <textarea class="form-control" name="reason" id="inputReason" placeholder="Reason"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                  <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        <!--end letter absence-->
                      </div>
                      <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                  </div>
                  <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
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
<script type="text/javascript">
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      $('.swalDefaultSuccess').click(function() {
        Toast.fire({
          icon: 'success',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultInfo').click(function() {
        Toast.fire({
          icon: 'info',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultError').click(function() {
        Toast.fire({
          icon: 'error',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultWarning').click(function() {
        Toast.fire({
          icon: 'warning',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultQuestion').click(function() {
        Toast.fire({
          icon: 'question',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });

      $('.toastrDefaultSuccess').click(function() {
        toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultInfo').click(function() {
        toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultError').click(function() {
        toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultWarning').click(function() {
        toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });

      $('.toastsDefaultDefault').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultTopLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'topLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomRight').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomRight',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultAutohide').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          autohide: true,
          delay: 750,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultNotFixed').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          fixed: false,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultFull').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          icon: 'fas fa-envelope fa-lg',
        })
      });
      $('.toastsDefaultFullImage').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          image: '../../dist/img/user3-128x128.jpg',
          imageAlt: 'User Picture',
        })
      });
      $('.toastsDefaultSuccess').click(function() {
        $(document).Toasts('create', {
          class: 'bg-success',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultInfo').click(function() {
        $(document).Toasts('create', {
          class: 'bg-info',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultWarning').click(function() {
        $(document).Toasts('create', {
          class: 'bg-warning',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultDanger').click(function() {
        $(document).Toasts('create', {
          class: 'bg-danger',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultMaroon').click(function() {
        $(document).Toasts('create', {
          class: 'bg-maroon',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
    });

  </script>
@endsection
