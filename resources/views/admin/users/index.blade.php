@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')
@can('create-user')
<x-buttons.primary :text="'create user'" :link="route('users.create')"  />
@endcan
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Users List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Avatar</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('users.index')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'avatar', name: 'avatar', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script>
@endpush
