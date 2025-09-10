@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Diskon</h1>
    <form action="{{ route('diskon.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_diskon" class="form-label">Nama Diskon</label>
            <input type="text" name="nama_diskon" id="nama_diskon" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="besar_diskon" class="form-label">Besar Diskon (%)</label>
            <input type="number" name="besar_diskon" id="besar_diskon" class="form-control" required min="0" max="100">
        </div>
        <div class="mb-3">
            <label for="jangka_waktu" class="form-label">Jangka Waktu (hari)</label>
            <input type="number" name="jangka_waktu" id="jangka_waktu" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
