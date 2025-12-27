@extends('layouts.auth')

@section('title', 'Login - NoWaits')

@section('content')
<style>
    body {
        background-color: #e9ecef;
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .login-container {
        display: flex;
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        overflow: hidden;
        width: 90%;
        max-width: 1200px;
        min-height: 650px;
    }

    .login-image-side {
        flex: 1.1;
        position: relative;
        background-image: url('https://images.unsplash.com/photo-1488477181946-6428a0291777?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'); 
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 50px;
        color: white;
    }

    .login-image-side::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 40%, rgba(0,0,0,0.8) 100%);
        z-index: 1;
    }

    .login-image-text {
        position: relative;
        z-index: 2;
    }

    .login-image-text h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        line-height: 1;
    }

    .login-image-text p {
        font-size: 1.15rem;
        line-height: 1.5;
        max-width: 90%;
    }

    .login-form-side {
        flex: 0.9;
        display: flex;
        flex-direction: column; 
        padding: 40px 60px;
        position: relative;
    }

    .top-bar {
        display: flex;
        justify-content: flex-end; 
        margin-bottom: 20px; 
    }

    .top-login-btn {
        background-color: #000;
        color: #fff;
        padding: 10px 60px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-block;
    }

    .form-wrapper {
        margin: auto 0; 
    }

    .login-heading h2 {
        color: #2c3e50;
        font-size: 2.5rem; 
        font-weight: 800;
        margin-bottom: 10px;
        line-height: 1.2;
    }

    .login-heading p {
        color: #95a5a6;
        font-size: 1.2rem;
        font-weight: 500;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        font-weight: 800;
        margin-bottom: 10px;
        color: #000;
    }

    .form-control {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #eee;
        border-radius: 50px;
        font-size: 1rem;
        outline: none;
        box-sizing: border-box; 
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #3483c9;
    }

    .btn-main-login {
        width: 100%;
        padding: 15px;
        background-color: #3483c9;
        color: white;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 800;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
    }

    .btn-main-login:hover {
        background-color: #2968a3;
    }

    .register-link {
        text-align: center;
        margin-top: 25px;
        color: #7f8c8d;
    }
    
    .register-link a {
        color: #3483c9;
        text-decoration: none;
        font-weight: 700;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .login-container { flex-direction: column; min-height: auto; }
        .login-image-side { min-height: 300px; padding: 30px; }
        .login-form-side { padding: 30px; }
        .login-heading h2 { font-size: 2rem; }
    }
</style>

<div class="login-container">
    <div class="login-image-side">
        <div class="login-image-text">
            <h1>Manage</h1>
            <p>A digital platform reducing fruit waste by connecting farmers to partners with smart pricing, logistics tracking, and sustainable redistribution systems.</p>
        </div>
    </div>

    <div class="login-form-side">
        
        <div class="top-bar">
            <a href="{{ route('login') }}" class="top-login-btn">Login</a>
        </div>

        <div class="form-wrapper">
            <div class="login-heading">
                <h2>Welcome Back to NoWaits</h2>
                <p>Sign to your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="user123@example.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="*********" required>
                </div>
                <button type="submit" class="btn-main-login">Login</button>
            </form>

            <div class="register-link">
                Don't have any account ? <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>
</div>

@endsection