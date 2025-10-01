@extends('adminlte::auth.login')

@section('auth_header', 'Login Admin')
@section('auth_body')
    <form action="{{ route('login_admin_form') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
        </div>
        <div class="form-group mt-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>
    </form>
@endsection
