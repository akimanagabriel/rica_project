@extends('layouts.login')

@section('content')
<!-- Content -->

<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Logo -->
        <div class="app-brand justify-content-center mb-5">
          <a href="/" class="app-brand-link gap-2">
            <span class="app-brand-text demo text-body fw-semibold">rica</span>
          </a>
        </div>
        <!-- /Logo -->
        <!-- Reset Password -->
        <div class="card">
          <div class="card-body">
            <h4 class="mb-2">Reset Password 🔒</h4>
            <p class="mb-4">Your new password must be different from previously used passwords</p>
            <form id="formAuthentication" class="mb-3" action="{{ route('password.update') }}" method="POST">
              @csrf
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
                    <label for="password">New Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="password"
                      id="confirm-password"
                      class="form-control"
                      name="confirm-password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <label for="confirm-password">Confirm Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100 mb-3">Set new password</button>
              <div class="text-center">
                <a href="/login" class="d-flex align-items-center justify-content-center">
                  <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                  Back to login
                </a>
              </div>
            </form>
          </div>
        </div>
        <!-- /Reset Password -->
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
