@extends('components.layouts.auth.app')

@section('title', 'Login')

@section('content')
<div class="container-login d-flex" style="height: 100vh; overflow: hidden;">
  <!-- Left Section: Illustration -->
  <div class="d-none d-lg-flex col-lg-6 align-items-center justify-content-center" style="background-color: #f9fafc; height: 100vh;">
    <div class="text-center">
      <img src="{{ asset('assets/images/logo/ilustrasi.png') }}" alt="Login Illustration" class="img-fluid" style="max-height: 350px;">
    </div>
  </div>

  <!-- Right Section: Login Form -->
  <div class="col-lg-6 d-flex align-items-center justify-content-center" style="background-color: white; height: 100vh;">
    <div class="w-100 px-4" style="max-width: 400px;">
      <!-- Logo -->
      <div class="mb-4 text-center">
        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" class="mb-4" style="height: 50px; margin: auto;">
      </div>

      <!-- Welcome Text -->
      <h4 class="text-primary mb-1" style="font-weight: bold;">Welcome Back,</h4>
      <p class="text-muted mb-4">Enter Username and Password</p>

      <!-- Login Form -->
      <form action="{{ route('login') }}" method="POST" class="pt-2">
        @csrf

        <!-- Username Field -->
        <div class="input-group mb-3">
          <span class="input-group-text bg-white border-0 border-bottom border-info rounded-0">
            <i class="ri-user-line text-muted"></i>
          </span>
          <input type="text" class="form-control border-0 border-bottom border-info rounded-0" name="email" placeholder="Username" required autocomplete="username" style="padding-left: 1px;">
          <x-form.validation.error name="email" />
        </div>

        <!-- Password Field -->
        <div class="input-group mb-4">
          <span class="input-group-text bg-white border-0 border-bottom border-info rounded-0">
            <i class="ri-lock-line text-muted"></i>
          </span>
          <input type="password" class="form-control border-0 border-bottom border-info rounded-0" name="password" placeholder="Password" required autocomplete="current-password" style="padding-left: 1px;">
          <button class="btn border-0 border-bottom border-info rounded-0" type="button" id="password-addon"><i class="ri-eye-line"></i></button>
          <x-form.validation.error name="password" />
        </div>

        <!-- Submit Button -->
        <button class="btn btn-outline-info w-100" type="submit">Login</button>
      </form>
    </div>
  </div>
</div>
@endsection
