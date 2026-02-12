<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label text-light">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label text-light">Password</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label text-muted" for="remember_me">Remember me</label>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-gold">
                Log In
            </button>
        </div>

        <div class="text-center mt-3">
            @if (Route::has('password.request'))
                <a class="text-decoration-none text-muted small" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
