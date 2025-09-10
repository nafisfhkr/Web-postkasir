<!-- @extends('layouts.app') -->


@section('content')
    <x-slot name="header">
        <h2 style="font-size: 1.5em; font-weight: bold; color: #444;">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="mt-4">
    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Foto Profil</label>
    
    @if (Auth::user()->profile_picture)
    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
     alt="Foto Profil" 
     style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">

    @else
        <p class="text-gray-500">Belum ada foto profil</p>
    @endif

    <form method="POST" action="{{ route('profile.update.picture') }}" enctype="multipart/form-data" class="mt-2">
        @csrf
        @method('PATCH')
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="form-control">
        <button type="submit" class="btn-unggah-foto">Unggah Foto</button>

    </form>
</div>


    <div style="padding: 50px 0; background-color: #f8f9fa;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
            <div style="background: #fff; border: 1px solid #ddd; padding: 30px; border-radius: 8px; margin-bottom: 20px;">
                <div style="max-width: 600px;">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div style="background: #fff; border: 1px solid #ddd; padding: 30px; border-radius: 8px; margin-bottom: 20px;">
                <div style="max-width: 600px;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div style="background: #fff; border: 1px solid #ddd; padding: 30px; border-radius: 8px; margin-bottom: 20px;">
                <div style="max-width: 600px;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
