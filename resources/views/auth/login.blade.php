@extends('layouts.app')

@section('title', 'Log In - Testwise')

@section('content')
<div class="max-w-md mx-auto my-12 px-4">
    <div class="p-8 rounded-3xl panel space-y-6">
        
        <!-- Header -->
        <div class="text-center">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-extrabold text-2xl mx-auto mb-3 shadow-md" style="background-color: var(--gold); color: var(--theme-bg);">
                T
            </div>
            <h2 class="text-2xl font-extrabold" style="color: var(--text-main) !important;">Welcome Back</h2>
            <p class="text-xs mt-1" style="color: var(--text-muted);">Log in to continue your MP Police GD 2026 preparation</p>
        </div>



        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="field">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="your.email@example.com">
                @error('email')
                    <p class="text-xs mt-1" style="color: var(--rose);">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer" style="justify-content: flex-start !important;">
                    <input type="checkbox" name="remember">
                    <span style="color: var(--text-muted);">Remember me</span>
                </label>
            </div>

            <button type="submit" class="w-full btn btn-gold font-bold shadow-lg" style="margin-top: 20px;">
                Sign In to Dashboard
            </button>
        </form>

        <p class="text-xs text-center mt-6" style="color: var(--text-muted);">
            Don't have an account? <a href="{{ route('register') }}" class="font-bold hover:underline" style="color: var(--gold-deep);">Register now</a>
        </p>
    </div>
</div>
@endsection
