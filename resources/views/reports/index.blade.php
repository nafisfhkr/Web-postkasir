<!-- resources/views/reports/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Laporan</h1>
<ul>
    <li><a href="{{ route('reports.transactions') }}">Laporan Transaksi</a></li>
    <li><a href="{{ route('reports.financials') }}">Laporan Keuangan</a></li>
</ul>
@endsection
