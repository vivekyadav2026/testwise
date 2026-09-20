@extends('layouts.app')

@section('title', 'Register - Testwise MP Police GD 2026')

@section('content')
<div class="max-w-md mx-auto my-12 px-4">
    <div class="p-8 rounded-3xl shadow-2xl panel">
        
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-extrabold text-2xl mx-auto mb-3 shadow-lg" style="background-color: var(--gold); color: var(--theme-bg);">
                T
            </div>
            <h2 class="text-2xl font-extrabold" style="color: var(--text-main) !important;">Create Account</h2>
            <p class="text-xs mt-1" style="color: var(--text-muted);">Enroll in MP Police Constable GD 2026 Batch</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="field">
                <label>Full Name (पूरा नाम)</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Rahul Sharma">
                @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com">
                @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label>Phone Number (मोबाइल नंबर)</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="9876543210">
                @error('phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label>Password</label>
                <input type="password" name="password" required>
                @error('password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="w-full btn btn-gold font-bold shadow-lg" style="margin-top: 20px;">
                Create Free Account & Start Learning
            </button>
        </form>

        <p class="text-xs text-center mt-6" style="color: var(--text-muted);">
            Already registered? <a href="{{ route('login') }}" class="font-bold hover:underline" style="color: var(--gold-deep);">Log in</a>
        </p>
    </div>
</div>
@endsection
