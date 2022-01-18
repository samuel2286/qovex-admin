@extends('layouts.auth')

@section('form')
<form class="form-horizontal" method="post" action="{{route('password.email')}}">
    @csrf
    <div class="alert alert-success text-center mb-4" role="alert">
        Enter your Email and instructions will be sent to you!
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" value="{{old('email')}}" placeholder="johndoe@gmail.com" name="email">
    </div>

    <div class="mt-3">
        <button class="btn btn-primary btn-block waves-effect waves-light"
            type="submit">Reset</button>
    </div>

</form>
@endsection

@push('form-footer')
<p>Remember It ? <a href="{{route('login')}}" class="font-weight-medium text-primary"> Sign In here</a> </p>
@endpush