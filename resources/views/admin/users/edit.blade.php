@extends('layouts.app')

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit User</h4>
            {!! form($form) !!}
        </div>
    </div>
</div>
@endsection

@push('page-js')
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <!-- form advanced init -->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
@endpush