@extends('layouts.login')

@section('title', 'Login')

@section('content')
    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-heading fw-bold text-primary">LICA MS V1</span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-2">
                        <h4 class="mb-2">Sign in! 👋</h4>
                        <p class="mb-4">Enter your username and password to access LICA MS V1.</p>

                        <form id="formAuthentication" class="mb-3" action="/login" method="POST">
                            @csrf
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Email or Username" value="{{ old('email') }}" autofocus />
                                <label for="email">Username</label>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" 
                                                name="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer">
                                            <i class="mdi mdi-eye-off-outline"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                                <a href="{{ route('password.request') }}" class="float-end mb-1">
                                    <span>Forgot Password?</span>
                                </a>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /Login -->
                
                <img src="../../assets/img/illustrations/auth-basic-mask-light.png"
                    class="authentication-image d-none d-lg-block" alt="triangle-bg"
                    data-app-light-img="illustrations/auth-basic-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-mask-dark.png" />
                
            </div>
        </div>
    </div>

    <!-- / Content -->
@endsection
