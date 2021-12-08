@extends('layouts.app')

@push('page-css')
    <link rel="stylesheet" href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}">
@endpush

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create User</h4>

            {!! form($form) !!}
        </div>
    </div>
</div>
@endsection

@push('page-js')
    <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
@endpush