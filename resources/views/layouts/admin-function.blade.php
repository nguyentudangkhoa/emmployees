@extends('master')
@section('title','Admin')
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


                <!-- /.col -->
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Approve absence Letter</a></li>
                        <li class="nav-item"><a class="nav-link" href="#overtime_em" data-toggle="tab">Employees overtime</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Salary</a></li>
                        <li class="nav-item"><a class="nav-link" href="#overtime" data-toggle="tab">Set overtime</a></li>
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
                                      <th>Reason reject</th>
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
  <div class="tab-pane" id="overtime_em">
    <div class="card-body table-responsive p-0" style="height: 100%;">
        <input type="hidden" name="" value="{{$i=0}}">
            <table id="example1" class="table table-hover text-nowrap">
              <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee's name</th>
                    <th>Date</th>
                    <th>Start at</th>
                    <th>End</th>
                    <th>Place</th>
                    <th>Task name</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Update at</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($overTime as $ot)
                <tr>
                    <td>{{$ot->id}}</td>
                    <td>{{$ot->user_name}}</td>
                    <td>{{$ot->date_ot}}</td>
                    <td>{{$ot->start_time}}</td>
                    <td>{{$ot->end_time}}</td>
                    <td>{{$ot->place_ot}}</td>
                    <td>{{$ot->task_name}}</td>
                    <td><p id="note{{ $ot->id }}">{{$ot->note}}</p></td>
                    <td><p id="status{{ $ot->id }}">{{ $ot->status }}</p></td>
                    <td>{{ $ot->created_at }}</td>
                    <td>{{ $ot->updated_at }}</td>
                  <td>
                    <div class="btn-group">
                        <button type="button" data-id="{{ $ot->id }}" data-note="{{ $ot->note }}" data-name="{{ $ot->user_name }}" class="btn-ot btn btn-success" data-toggle="modal" data-target="#modal-setOT">
                            Update status
                        </button>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-setOT">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Approve</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="ot_id" name="ot_id">
            <div class="form-group row">
                <label for="em_name" class="col-sm-2 col-form-label">Employee's Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="em_name" id="em_name" value="" placeholder="Name" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="em_status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" name="em_status" id="em_status">
                      <option selected="" disabled="">Select One</option>
                      <option>Fails</option>
                      <option>Success</option>
                  </select>
                </div>
                <p id="sta_vef" style="color:red;font-weight:bold; display: none"></p>
            </div>
            <div class="form-group row">
                <label for="em_note" class="col-sm-2 col-form-label">Note</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="em_note" id="em_note" placeholder="Note" ></textarea>
                </div>
                <p id="note_vef" style="color:red;font-weight:bold ;display: none"></p>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" id="close-ot" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="confirm_ot" class="btn btn-primary"  data-token="{{ csrf_token() }}">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


                        <div class="tab-pane" id="settings">
                            <div class="card-body table-responsive p-0" style="height: 100%;">
                                <input type="hidden" name="" value="{{$i=0}}">
                                    <table id="example2" class="table table-hover text-nowrap">
                                      <thead>
                                        <tr>
                                          <th>No</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Position</th>
                                          <th>Salary</th>
                                          <th>Option</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach ($salary as $sala)
                                        <tr>
                                          <td>{{++$i}}</td>
                                          <td>{{$sala->name}}</td>
                                          <td>{{$sala->email}}</td>
                                          <td>{{$sala->position}}</td>
                                          <td><p id="p{{ $sala->id }}">{{number_format($sala->salary)}} VND</p></td>
                                          <td>
                                            <div class="btn-group">
                                                <button type="button" data-id="{{ $sala->id }}" data-name="{{ $sala->name }}" class="btn-option-salary btn btn-success" data-toggle="modal" data-target="#modal-option">
                                                    Add new salary
                                                </button>
                                                <form action="{{ route('print-PDF', $sala->id) }}" method="get">
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-print"></i> Print PDF</button>
                                                </form>
                                            </div>
                                          </td>
                                        </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                        </div>
                        <!-- /.tab-pane -->
                         <!-- /.modal -->

      <div class="modal fade" id="modal-option">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Salary Oprion</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_add_salary" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group row">
                        <label for="user-name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="user_name" value="" placeholder="Name" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user-salary" class="col-sm-2 col-form-label">Salary</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="salary" id="user-salary" value="" placeholder="Salary">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" id="btn-add-salary" class="btn btn-danger">Add new salary</button>
                        </div>
                      </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
                        <!--Letter absence-->
                        <div class="tab-pane" id="overtime">
                            <form class="form-horizontal"  id="form-overtime"  method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_member" id="id" value="{{Auth::user()->id}}">
                              <div class="form-group row">
                                <label for="inputDateOverTime" class="col-sm-2 col-form-label">Date Overtime</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="date_overtime" id="inputDateOverTime" placeholder="From" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputNameEm" class="col-sm-2 col-form-label">Employee's name</label>
                                <div class="col-sm-10">
                                  <select id="inputNameEm" name="mem_id" class="form-control custom-select" required>
                                    <option selected="" disabled="">Select one</option>
                                    @foreach ($user_name as $name)
                                        <option data-id="{{ $name->id }}">{{ $name->id }}-{{ $name->name }}</option>
                                    @endforeach

                                  </select>

                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputPlaceOT" class="col-sm-2 col-form-label">Place OT</label>
                                <div class="col-sm-10">
                                  <select id="inputPlaceOT" name="place_ot" class="form-control custom-select" required>
                                    <option selected="" disabled="">Select one</option>
                                    <option >Back end</option>
                                    <option >Front end</option>
                                    <option >Tester QC/QA</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputFromHour" class="col-sm-2 col-form-label">From</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" name="from_hour" id="inputFromHour" placeholder="From" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputToHour" class="col-sm-2 col-form-label">To</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" name="to_hour" id="inputToHour" placeholder="To" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputTaskName" class="col-sm-2 col-form-label">Task name</label>
                                <div class="col-sm-10">
                                  <textarea class="form-control" name="task_name" id="inputTaskName" placeholder="Task name" required></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputNoteOT" class="col-sm-2 col-form-label">Note</label>
                                <div class="col-sm-10">
                                  <textarea class="form-control" name="note_ot" id="inputNoteOT" placeholder="Note" required></textarea>
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
