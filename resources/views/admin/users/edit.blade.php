@extends('layouts.app')

@push('page-css')
    
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
    
@endpush