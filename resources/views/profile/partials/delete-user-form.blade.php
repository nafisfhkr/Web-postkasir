<section style="padding: 30px; background-color: #ffebee; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-top: 30px;">
    <header style="border-bottom: 2px solid #ffcdd2; padding-bottom: 15px; margin-bottom: 15px;">
        <h2 style="font-size: 1.2em; font-weight: bold; color: #b71c1c;">
            {{ __('Delete Account') }}
        </h2>
        <p style="font-size: 0.9em; color: #666;">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    <button onclick="document.getElementById('confirm-user-deletion-modal').style.display = 'block';" 
            style="background-color: #b71c1c; color: white; padding: 8px 15px; border: none; border-radius: 4px;">
        {{ __('Delete Account') }}
    </button>

    <div id="confirm-user-deletion-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);">
        <form method="post" action="{{ route('profile.destroy') }}" style="background: white; padding: 30px; border-radius: 8px; max-width: 400px; margin: 100px auto;">
            @csrf
            @method('delete')

            <h2 style="font-size: 1.2em; font-weight: bold; color: #b71c1c;">{{ __('Are you sure you want to delete your account?') }}</h2>
            <p style="font-size: 0.9em; color: #666;">{{ __('Please enter your password to confirm you would like to permanently delete your account.') }}</p>

            <div style="margin-top: 15px;">
                <label for="password" style="display: block; font-weight: bold;">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" 
                       style="width: 100%; padding: 8px; border: 1px solid #ffcdd2; border-radius: 4px;" placeholder="{{ __('Password') }}">
                <x-input-error :messages="$errors->userDeletion->get('password')" style="color: red; margin-top: 5px;" />
            </div>

            <div style="margin-top: 15px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="document.getElementById('confirm-user-deletion-modal').style.display = 'none';" 
                        style="background-color: #ddd; color: #444; padding: 8px 15px; border: none; border-radius: 4px;">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" style="background-color: #b71c1c; color: white; padding: 8px 15px; border: none; border-radius: 4px;">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </div>
</section>
