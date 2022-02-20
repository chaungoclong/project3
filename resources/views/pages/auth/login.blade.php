@extends('layouts.admin.auth')
@section('pageName', 'Login')
@section('classBodyAuth', 'login-page')
@section('classWrapperAuth', 'login-box')
@section('classLogoAuth', 'login-logo')
    
@section('content')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                Sign in to start your session
            </p>

            <form action="{{ route('login.process') }}" method="post">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <input class="form-control @error('email') is-invalid @enderror" 
                            name="email" placeholder="Email" type="email" 
                            value="{{ old('email', '') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope">
                                    </span>
                                </div>
                            </div>
                        </input>
                        <x-input-error for="email"/>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <input class="form-control @error('password') is-invalid @enderror" 
                            name="password" placeholder="Password" 
                            type="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock">
                                    </span>
                                </div>
                            </div>
                        </input>
                        <x-input-error for="password"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input id="remember" type="checkbox" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </input>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button class="btn btn-primary btn-block" type="submit">
                            Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="social-auth-links text-center mb-3">
                <p>
                    - OR -
                </p>
                <a class="btn btn-block btn-primary" href="#">
                    <i class="fab fa-facebook mr-2">
                    </i>
                    Sign in using Facebook
                </a>
                <a class="btn btn-block btn-danger" href="#">
                    <i class="fab fa-google-plus mr-2">
                    </i>
                    Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->
            <p class="mb-1">
                <a href="forgot-password.html">
                    I forgot my password
                </a>
            </p>
            <p class="mb-0">
                <a class="text-center" href="register.html">
                    Register a new membership
                </a>
            </p>
        </div>
    <!-- /.login-card-body -->
    </div>
@stop
