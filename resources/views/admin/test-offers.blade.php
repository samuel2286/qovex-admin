@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')
@can('create-TestOffer')
<x-buttons.primary :text="'Create Test Offer'" :target="'#addTestOffer'"  />
@endcan
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Test Offer List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
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
    <div id="addTestOffer" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Create Test Offer
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('test-offer')}}" method="post" class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="offer">Name</label>
                            <input id="offer" type="text" class="form-control" name="name" placeholder="FBC">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input id="price" type="text" class="form-control" name="price" placeholder="100">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control" name="description" id="desc" cols="30" rows="10" placeholder="Enter description for the test"></textarea>
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
    <div id="editTestOffer" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Test Offer
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('test-offer')}}" method="post" class="needs-validation updateForm" novalidate>
                    <div class="modal-body">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_offer">Name</label>
                            <input id="edit_offer" type="text" class="form-control" name="name" placeholder="FBC">
                        </div>
                        <div class="form-group">
                            <label for="edit_price">Price</label>
                            <input id="edit_price" type="text" class="form-control" name="price" placeholder="100">
                        </div>
                        <div class="form-group">
                            <label for="edit_desc">Description</label>
                            <textarea class="form-control" name="description" id="edit_desc" cols="30" rows="10" placeholder="Enter description for the test"></textarea>
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
    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('test-offer')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'test_price', name: 'test_price'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#datatable').on('click','.edit',function(){
                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var description = $(this).data('description');
                $('#editTestOffer').modal('show');
                $('#edit_offer').val(name);
                $('#edit_price').val(price);
                $('#edit_desc').val(description);
                $('#edit_id').val(id);
            });
        });
    </script>
@endpush
