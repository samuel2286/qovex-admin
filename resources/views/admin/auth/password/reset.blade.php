@extends('layouts.auth')

@section('form')
<form class="form-horizontal" method="post" action="{{route('password.update')}}">
    @csrf
    @if (session('status'))
    <div class="alert alert-success text-center mb-4" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <input type="hidden" name="token" value="{{request()->route('token')}}">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" value="{{request()->get('email')}}" placeholder="johndoe@gmail.com" name="email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="form-group">
        <label for="repeat_password">Repeat Password</label>
        <input type="password" name="password_confirmation" class="form-control" id="repeat_password">
    </div>

    <div class="mt-3">
        <button class="btn btn-primary btn-block waves-effect waves-light"
            type="submit">Reset</button>
    </div>

</form>
@endsection

@push('form-footer')

@endpush