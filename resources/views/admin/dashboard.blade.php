@extends('layouts.app')

@push('page-css')

@endpush

@section('content')
@if (auth()->user()->hasRole('patient'))
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="avatar-sm font-size-20 me-3">
                    <span class="avatar-title bg-soft-primary text-primary rounded">
                        <i class="mdi mdi-account-multiple-outline"></i>
                    </span>
                </div>
                <div class="flex-1">
                    <div class="font-size-16 mt-2">My Test</div>
                </div>
            </div>
            <h4 class="mt-4">{{$user_test_results_count}}</h4>
            <div class="row">
                <div class="col-5 align-self-center">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="avatar-sm font-size-20 me-3">
                    <span class="avatar-title bg-soft-primary text-primary rounded">
                        <i class="mdi mdi-account-multiple-outline"></i>
                    </span>
                </div>
                <div class="flex-1">
                    <div class="font-size-16 mt-2">My Appointments</div>
                </div>
            </div>
            <h4 class="mt-4">{{auth()->user()->appointments->count()}}</h4>
            <div class="row">
                <div class="col-5 align-self-center">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="avatar-sm font-size-20 me-3">
                    <span class="avatar-title bg-soft-primary text-primary rounded">
                        <i class="mdi mdi-account-multiple-outline"></i>
                    </span>
                </div>
                <div class="flex-1">
                    <div class="font-size-16 mt-2">Users</div>
                </div>
            </div>
            <h4 class="mt-4">{{\App\Models\User::count()}}</h4>
            <div class="row">
                <div class="col-5 align-self-center">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="avatar-sm font-size-20 me-3">
                    <span class="avatar-title bg-soft-primary text-primary rounded">
                        <i class="mdi mdi-account-multiple-outline"></i>
                    </span>
                </div>
                <div class="flex-1">
                    <div class="font-size-16 mt-2">Test Offers</div>
                </div>
            </div>
            <h4 class="mt-4">{{\App\Models\TestOffer::count()}}</h4>
            <div class="row">
                <div class="col-5 align-self-center">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="avatar-sm font-size-20 me-3">
                    <span class="avatar-title bg-soft-primary text-primary rounded">
                        <i class="mdi mdi-account-multiple-outline"></i>
                    </span>
                </div>
                <div class="flex-1">
                    <div class="font-size-16 mt-2">Appointments</div>
                </div>
            </div>
            <h4 class="mt-4">{{\App\Models\Appointment::count()}}</h4>
            <div class="row">
                <div class="col-5 align-self-center">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="avatar-sm font-size-20 me-3">
                    <span class="avatar-title bg-soft-primary text-primary rounded">
                        <i class="mdi mdi-tag-plus-outline"></i>
                    </span>
                </div>
                <div class="flex-1">
                    <div class="font-size-16 mt-2">Patients</div>
                </div>
            </div>
            <h4 class="mt-4">{{\App\Models\User::role('patient')->count()}}</h4>
            <div class="row">
                <div class="col-5 align-self-center">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('page-js')

@endpush
