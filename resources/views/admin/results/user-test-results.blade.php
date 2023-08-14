@extends('layouts.app')

<x-assets.datatables />

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush


@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">My Test Result List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Appointment</th>
                            <th>summary</th>
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
                <form action="" method="post" class="needs-validation updateForm" novalidate>
                    <div class="modal-body">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_summary">Summary</label>
                                <textarea class="form-control" name="summary" id="edit_summary" cols="10" rows="2" placeholder="Enter summary"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_details">Details</label>
                                <textarea class="form-control" name="details" id="edit_details" cols="10" rows="10" placeholder="Enter Details"></textarea>
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
                ajax: "{{route('my-test-results')}}",
                columns: [
                    {data: 'appointment', name: 'appointment'},
                    {data: 'summary', name: 'summary'},
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
                $('#edit_details').val(details);
            });


        });
    </script>
@endpush
