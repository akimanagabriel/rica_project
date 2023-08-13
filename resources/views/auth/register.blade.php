@extends('layouts.login')

@section('title','register')

@section('content')
<!-- Content -->

<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Register Card -->
        <div class="card p-2">
          <!-- Logo -->
          <div class="app-brand justify-content-center mt-5">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
              </span>
              <span class="app-brand-text demo text-heading fw-semibold">rica</span>
            </a>
          </div>
          <!-- /Logo -->
          <div class="card-body mt-2">
            <h4 class="mb-2">Adventure starts here 🚀</h4>
            <p class="mb-4">Make your app management easy and fun!</p>

            <form id="formAuthentication" class="mb-3" action="/register" method="POST">
                @csrf
              <div class="form-floating form-floating-outline mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  placeholder="Enter your username"
                  autofocus />
                <label for="username">Username</label>
              </div>
              <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                <label for="email">Email</label>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <label for="password">Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>

              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="javascript:void(0);">privacy policy & terms</a>
                  </label>
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100">Sign up</button>
            </form>

            <p class="text-center">
              <span>Already have an account?</span>
              <a href="/login">
                <span>Sign in instead</span>
              </a>
            </p>

            <div class="divider my-4">
              <div class="divider-text">or</div>
            </div>

            <div class="d-flex justify-content-center gap-2">
              <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
                <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
                <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
                <i class="tf-icons mdi mdi-24px mdi-github"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                <i class="tf-icons mdi mdi-24px mdi-google"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- Register Card -->
        <img
          src="../../assets/img/illustrations/tree-3.png"
          alt="auth-tree"
          class="authentication-image-object-left d-none d-lg-block" />
        <img
          src="../../assets/img/illustrations/auth-basic-mask-light.png"
          class="authentication-image d-none d-lg-block"
          alt="triangle-bg"
          data-app-light-img="illustrations/auth-basic-mask-light.png"
          data-app-dark-img="illustrations/auth-basic-mask-dark.png" />
        <img
          src="../../assets/img/illustrations/tree.png"
          alt="auth-tree"
          class="authentication-image-object-right d-none d-lg-block" />
      </div>
    </div>
  </div>

  <!-- / Content -->
@endsection
