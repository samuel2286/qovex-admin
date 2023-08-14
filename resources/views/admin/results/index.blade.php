@extends('layouts.app')

<x-assets.datatables />

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('breadcrumb')
<x-buttons.primary :text="'Submit Results'" :target="'#addResults'"  />
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Test Result List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Appointment</th>
                            <th>summary</th>
                            <th>Send SMS</th>
                            <th>Approved By</th>
                            <th>Created At</th>
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
    <div id="addResults" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('test-results')}}" method="post" class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <label for="appointment">Appointment</label>
                                <select data-placeholder="select appointment" name="appointment" id="appointment" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($appointments as $appointment)
                                        <option value="{{$appointment->id}}">{{$appointment->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="summary">Summary</label>
                                <textarea class="form-control" name="summary" id="summary" cols="10" rows="2" placeholder="Enter summary"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="details">Details</label>
                                <textarea class="form-control tinymce" name="details" id="details" cols="10" rows="10" placeholder="Enter Details"></textarea>
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="input-group">
                                <input type="text" id="file_upload_input" class="form-control" name="file"
                                       aria-label="Image" aria-describedby="file_upload">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="file_upload">Select</button>
                                </div>
                            </div>
                        </div> --}}
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
    <div id="editTestResult" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('test-results')}}" method="post" class="needs-validation updateForm" novalidate>
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_appointment">Appointment</label>
                                <select data-placeholder="select appointment" name="appointment" id="edit_appointment" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($appointments as $appointment)
                                        <option value="{{$appointment->id}}">{{$appointment->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_summary">Summary</label>
                                <textarea class="form-control" name="summary" id="edit_summary" cols="10" rows="2" placeholder="Enter summary"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_details">Details</label>
                                <textarea class="form-control tinymce" name="details" id="edit_details" cols="10" rows="10" placeholder="Enter Details"></textarea>
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

    <div id="sendSMSMessage" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="phone" id="phone">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" name="message" id="message" cols="10" rows="10" placeholder="Enter message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn send_notification btn-primary waves-effect waves-light">Send</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@push('page-js')
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/tinymce/tinymce.min.js')}}"></script>
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
                ajax: "{{route('test-results')}}",
                columns: [
                    {data: 'patient', name: 'patient'},
                    {data: 'appointment', name: 'appointment'},
                    {data: 'summary', name: 'summary'},
                    {data: 'send_sms', name: 'send_sms'},
                    {data: 'added_by', name: 'added_by'},
                    {data: 'date_created', name: 'date_created'},
                    {data: 'action', name: 'action'},
                ]
            });
            $('#datatable').on('click','.edit',function(){
                var id = $(this).data('id');
                var appointment = $(this).data('appointment');
                var summary = $(this).data('summary');
                var details = $(this).data('details');
                $('#editTestResult').modal('show');
                $('#edit_id').val(id);
                $('#edit_appointment').val(appointment).trigger('change');
                $('#edit_summary').val(summary);
                // $('#edit_details').val(details);
                tinymce.get('edit_details').setContent(details);
            });
            $('.modal #file_upload').click(function(event){
                event.preventDefault();
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            })
            $('table').on('click','.send_sms_btn',function(){
                $('#sendSMSMessage').modal('show');
                var phone = $(this).data('phone');
                $('#phone').val(phone);
            });
            $('.send_notification').click(function(e){
                e.preventDefault();
                $('#sendSMSMessage').modal('hide');
                var phone = $('#phone').val();
                var message = $('#message').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('sendSMS')}}",
                    data: {
                        phone: phone,
                        message: message,
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
                    },
                });
                $('#message').val("").trigger('change');
            });
            function fmSetLink($url) {
                $('.modal #file_upload_input').val($url);
            }
            $('.tinymce').each(function(){

                let id= $(this).attr('id');
                tinymce.init({
                    selector: ('#'+id),
                    file_picker_callback (callback, value, meta) {
                        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                        let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight
                        tinymce.activeEditor.windowManager.openUrl({
                        url : '/file-manager/tinymce5',
                        title : 'Laravel File manager',
                        width : x * 0.8,
                        height : y * 0.8,
                        onMessage: (api, message) => {
                            callback(message.content, { text: message.text })
                        }
                        })
                    }
                });
            })
        });
    </script>
@endpush
