@extends('layouts.app')

<x-assets.datatables />

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('breadcrumb')
@can('create-TestOffer')
<x-buttons.primary :text="'Create Appointment'" :target="'#addAppointment'"  />
@endcan
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Appointment List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Patient Name</th>
                            <th>Tests</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Approved By</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- create modal -->
    <div id="addAppointment" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('appointments')}}" method="post" class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <label for="patient">Patient</label>
                                <select data-placeholder="select patient" name="patient" id="patient" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($patients as $patient)
                                        <option value="{{$patient->id}}">{{$patient->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tests">Tests</label>
                                <select data-placeholder="select tests" name="tests[]" id="tests" class="form-control select2" multiple>
                                    <option value=""></option>
                                    @foreach ($tests as $test)
                                        <option value="{{$test->id}}">{{$test->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <input id="gender" type="text" class="form-control" name="gender" placeholder="male">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" cols="2" rows="2" placeholder="Enter address"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="date">Appointment Date</label>
                                <input id="date" type="date" class="form-control" name="date">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- edit modal -->
    <div id="editAppointment" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('appointments')}}" method="post" class="needs-validation updateForm" novalidate>
                    <div class="modal-body">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="id" id="edit_id">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_patient">Patient</label>
                                <select data-placeholder="select patient" name="patient" id="edit_patient" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($patients as $patient)
                                        <option value="{{$patient->id}}">{{$patient->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_tests">Tests</label>
                                <select data-placeholder="select tests" name="tests[]" id="edit_tests" class="form-control select2" multiple>
                                    <option value=""></option>
                                    @foreach ($tests as $test)
                                        <option value="{{$test->id}}">{{$test->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_gender">Gender</label>
                                <input id="edit_gender" type="text" class="form-control" name="gender" placeholder="male">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_address">Address</label>
                                <textarea class="form-control" name="address" id="edit_address" cols="2" rows="2" placeholder="Enter address"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_date">Appointment Date</label>
                                <input id="edit_date" type="date" class="form-control" name="date">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('page-js')
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.select2').each(function(){
                $(this).select2({
                    width: "100%"
                })
            })
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('appointments')}}",
                columns: [
                    {data: 'code', name: 'code'},
                    {data: 'patient', name: 'patient'},
                    {data: 'tests', name: 'tests'},
                    {data: 'gender', name: 'gender'},
                    {data: 'address', name: 'address'},
                    {data: 'stat', name: 'stat'},
                    {data: 'approved_by', name: 'approved_by'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#datatable').on('click','.edit',function(){
                var id = $(this).data('id');
                var patient = $(this).data('patient');
                var tests = $(this).data('tests');
                var date = $(this).data('date');
                var gender = $(this).data('gender');
                var address = $(this).data('address');
                $('#editAppointment').modal('show');
                $('#edit_id').val(id);
                $('#edit_patient').val(patient).trigger('change');
                $('#edit_tests').val(tests).trigger('change');
                $('#edit_gender').val(gender);
                $('#edit_address').val(address);
                $('#edit_date').val(date);
            });
            $('table').on('click','.update_status', function(){
                var status = $(this).data('status');
                var id = $(this).data('id');
                $.ajax({
                    url: "{{route('appointment.update-stat')}}",
                    type: "POST",
                    data: {
                        appointment: id,
                        status: status
                    },
                    success: function(e){
                    if(e.type == '1'){
                        toastr.success(e.message)
                    }
                    if(e.type == '0'){
                        toastr.error(e.message)
                    }
                    },
                    complete: function(){
                        $('#datatable').DataTable().ajax.reload();
                    }
                })
                })
        });
    </script>
@endpush
