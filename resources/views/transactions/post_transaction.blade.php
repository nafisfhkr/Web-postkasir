@extends('layouts.app')

@section('content')
<h1>Transaksi Berhasil</h1>

<!-- Tampilkan Pesan Sukses -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Informasi Transaksi -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Detail Transaksi</h5>
        <p><strong>Nama Customer:</strong> {{ $transaction->customer->nama }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>
        <p><strong>Diskon:</strong> Rp {{ number_format($transaction->diskon, 0, ',', '.') }}</p>
        <p><strong>Tanggal Transaksi:</strong> {{ $transaction->Tanggal_transaksi }}</p>
    </div>
</div>

<!-- Pilihan Aksi -->
<div class="d-flex justify-content-between">
    <a href="{{ route('transactions.index') }}" class="btn btn-primary">Kembali ke Halaman Transaksi</a>
    <a href="{{ route('transactions.receipt', ['id' => $transaction->TransaksiID]) }}" class="btn btn-secondary" target="_blank">Lihat Resi</a>
    <a href="{{ route('transactions.print', ['id' => $transaction->TransaksiID]) }}" class="btn btn-success" target="_blank">Cetak Resi</a>
</div>
@endsection
