@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Staff</h1>
    <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="penggunaID" class="form-label">Nama Pengguna</label>
            <select name="penggunaID" id="penggunaID" class="form-select @error('penggunaID') is-invalid @enderror">
                <option value="">-- Pilih Pengguna --</option>
                @foreach($pengguna as $item)
                <option value="{{ $item->id }}" {{ old('penggunaID') == $item->id ? 'selected' : '' }}>
                    {{ $item->Nama }}
                </option>
                @endforeach
            </select>
            @error('penggunaID')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
            @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Jabatan" class="form-label">Jabatan</label>
            <input type="text" name="Jabatan" id="Jabatan" class="form-control @error('Jabatan') is-invalid @enderror" value="{{ old('Jabatan') }}">
            @error('Jabatan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Gaji" class="form-label">Gaji</label>
            <input type="number" step="0.01" name="Gaji" id="Gaji" class="form-control @error('Gaji') is-invalid @enderror" value="{{ old('Gaji') }}">
            @error('Gaji')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('staff.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </form>
</div>
@endsection
