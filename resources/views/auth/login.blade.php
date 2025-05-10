<x-guest-layout>
    <h1>Welcome back</h1>
    <p class="subtitle">Please enter your details to sign in</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}"">
        @csrf

        <div class=" form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-inherit bg-gray-200" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="form-row">
            <div class="remember-me">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-indigo-600 focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <button type="submit" class="login-button">login</button>
            <p class="signup-link">
                Don't have an account? <a class="inline-block" href="register">Sign up</a>
            </p>

        </div>
    </form>

</x-guest-layout>
