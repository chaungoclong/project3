@extends('layouts.admin.auth')
@section('pageName', 'Register')
@section('classBodyAuth', 'register-page')
@section('classWrapperAuth', 'register-box')
@section('classLogoAuth', 'register-logo')

@section('content')
    <div class="card">
        <div class="card-body register-card-body">
            <p class="register-box-msg">
                Sign in to start your session
            </p>

            <form action="{{ route('register.process') }}" method="post">
                @csrf
                
                <div class="mb-3">
                    <div class="input-group">
                        <input 
                            class="form-control @error('last_name') is-invalid @enderror" 
                            name="last_name" placeholder="Last name" type="text" 
                            value="{{ old('last_name', '') }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-align-justify"></i>
                            </div>
                        </div>
                        <x-input-error for="last_name"/>
                    </div>
                </div>
                   
                <div class="mb-3">
                    <div class="input-group">
                        <input 
                            class="form-control @error('first_name') is-invalid @enderror" 
                            name="first_name" placeholder="First name" type="text" 
                            value="{{ old('first_name', '') }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                               <i class="fas fa-align-justify"></i>
                            </div>
                        </div>
                        <x-input-error for="first_name"/>
                    </div>
                </div>
                   
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
                            name="password" placeholder="Password" type="password">
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
                    <div class="col-4">
                        <button class="btn btn-primary btn-block" type="submit">
                            Sign Up
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->
            <p class="mb-1">
                <a href="{{ route('login.form') }}">
                    Login
                </a>
            </p>
        </div>
    <!-- /.login-card-body -->
    </div>
@stop


