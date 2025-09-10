<section style="padding: 30px; background-color: #e8f5e9; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-top: 30px;">
    <header style="border-bottom: 2px solid #c8e6c9; padding-bottom: 15px; margin-bottom: 15px;">
        <h2 style="font-size: 1.2em; font-weight: bold; color: #388e3c;">
            {{ __('Update Password') }}
        </h2>
        <p style="font-size: 0.9em; color: #666;">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" style="margin: 0;">
        @csrf
        @method('put')

        <div style="margin-bottom: 15px;">
            <label for="current_password" style="display: block; font-weight: bold;">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" 
                   style="width: 100%; padding: 8px; border: 1px solid #c8e6c9; border-radius: 4px;" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" style="color: red; margin-top: 5px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; font-weight: bold;">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" 
                   style="width: 100%; padding: 8px; border: 1px solid #c8e6c9; border-radius: 4px;" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" style="color: red; margin-top: 5px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password_confirmation" style="display: block; font-weight: bold;">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" 
                   style="width: 100%; padding: 8px; border: 1px solid #c8e6c9; border-radius: 4px;" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" style="color: red; margin-top: 5px;" />
        </div>

        <div style="display: flex; align-items: center; gap: 10px;">
            <button type="submit" style="background-color: #388e3c; color: white; padding: 8px 15px; border: none; border-radius: 4px;">
                {{ __('Save') }}
            </button>
            @if (session('status') === 'password-updated')
                <p style="font-size: 0.9em; color: #388e3c;">Password updated successfully!</p>
            @endif
        </div>
    </form>
</section>
