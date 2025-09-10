<section style="padding: 30px; background-color: #e8f5e9; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <header style="border-bottom: 2px solid #c8e6c9; padding-bottom: 15px; margin-bottom: 15px;">
        <h2 style="font-size: 1.2em; font-weight: bold; color: #388e3c;">
            {{ __('Profile Information') }}
        </h2>
        <p style="font-size: 0.9em; color: #666;">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" style="margin: 0;">
        @csrf
        @method('patch')

        <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; font-weight: bold;">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" style="width: 100%; padding: 8px; border: 1px solid #c8e6c9; border-radius: 4px;" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" style="color: red; margin-top: 5px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; font-weight: bold;">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" style="width: 100%; padding: 8px; border: 1px solid #c8e6c9; border-radius: 4px;" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" style="color: red; margin-top: 5px;" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="font-size: 0.9em; color: #555; margin-top: 10px;">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" style="background: none; border: none; text-decoration: underline; color: #388e3c;">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <p style="margin-top: 10px; font-size: 0.9em; color: #388e3c;">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 10px;">
            <button type="submit" style="background-color: #388e3c; color: white; padding: 8px 15px; border: none; border-radius: 4px;">
                {{ __('Save') }}
            </button>
            @if (session('status') === 'profile-updated')
                <p style="font-size: 0.9em; color: #388e3c;">Profile updated successfully!</p>
            @endif
        </div>
    </form>
</section>
