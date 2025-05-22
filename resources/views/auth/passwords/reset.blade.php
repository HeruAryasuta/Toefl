@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 d-flex align-items-center min-vh-100 py-5">
            <!-- Left side illustration -->
            <div class="col-md-6 d-none d-md-block pe-5">
                <div class="position-relative">
                    <img src="{{ asset('images/phone-illustration.svg') }}" alt="Illustration" class="img-fluid">
                    <img src="{{ asset('images/document-bg.svg') }}" alt="" class="position-absolute" style="left: -30px; top: 50px; z-index: -1; opacity: 0.8; width: 100px;">
                    <img src="{{ asset('images/plant.svg') }}" alt="" class="position-absolute" style="left: 10px; bottom: -20px; width: 70px;">
                </div>
                
                <h3 class="text-center mt-4 mb-2">Reset Password</h3>
                <p class="text-center text-muted">Create a new password for your account.</p>
                
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none">Back to Login Page</a>
                </div>
            </div>
            
            <!-- Right side form -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="text-center mb-4">Reset Password</h4>
                        
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="new-password">
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password-confirm" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" 
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary py-2">
                                    Reset Password
                                </button>
                            </div>
                            
                            <div class="mt-4 text-center">
                                <p class="mb-0">
                                    <a href="{{ route('login') }}" class="text-decoration-none">
                                        Back to Login
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }
    
    .card {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .form-control {
        padding: 0.6rem 1rem;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
    }
    
    .form-control:focus {
        border-color: #5468ff;
        box-shadow: 0 0 0 0.2rem rgba(84, 104, 255, 0.15);
    }
    
    .btn-primary {
        background-color: #0d3a69;
        border-color: #0d3a69;
        border-radius: 6px;
        font-weight: 500;
    }
    
    .btn-primary:hover {
        background-color: #0a2e53;
        border-color: #0a2e53;
    }
    
    a {
        color: #0d3a69;
    }
    
    a:hover {
        color: #0a2e53;
    }
</style>
@endpush