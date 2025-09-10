@extends('layouts.app')

@section('content')
@php
    $hour = now()->hour;
    if ($hour >= 5 && $hour < 12) {
        $greeting = "Selamat Pagi";
    } elseif ($hour >= 12 && $hour < 18) {
        $greeting = "Selamat Siang";
    } elseif ($hour >= 18 && $hour < 21) {
        $greeting = "Selamat Sore";
    } else {
        $greeting = "Selamat Malam";
    }
@endphp

<h1 class="mb-4">{{ $greeting }}, {{ Auth::user()->name }}</h1> 

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


<div class="row">
    <!-- Total Pengguna -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow-sm border-primary">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-users fa-lg"></i> Total Pengguna
            </div>
            <div class="card-body text-center">
                <h3>{{ $totalUsers }}</h3>
                <p class="mb-0">Pengguna</p>
            </div>
        </div>
        <canvas id="userChart" width="400" height="200"></canvas>
    </div>

    <!-- Total Transaksi -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow-sm border-success">
            <div class="card-header bg-success text-white">
                <i class="fas fa-shopping-cart fa-lg"></i> Total Transaksi
            </div>
            <div class="card-body text-center">
                <h3>{{ $totalTransactions }}</h3>
                <p class="mb-0">Transaksi</p>
            </div>
        </div>
        <canvas id="transactionChart" width="400" height="200"></canvas>
    </div>

    <!-- Total Pendapatan -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow-sm border-warning">
            <div class="card-header bg-warning text-white">
                <i class="fas fa-dollar-sign fa-lg"></i> Total Pendapatan
            </div>
            <div class="card-body text-center">
                <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p class="mb-0">Pendapatan</p>
            </div>
        </div>
        <canvas id="revenueChart" width="400" height="200"></canvas>
    </div>
</div>

<div class="row">
    <!-- Grafik Customer per Bulan -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm border-info">
            <div class="card-header bg-info text-white">
                <i class="fas fa-chart-line fa-lg"></i> Grafik Jumlah Pelanggan per Bulan
            </div>
            <div class="card-body">
                <canvas id="customerChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Kalender -->
    <div class="col-lg-4 mb-4">
    <div class="card shadow-sm border-secondary">
        <div class="card-header bg-secondary text-white">
            <i class="fas fa-calendar-alt fa-lg"></i> Kalender
        </div>
        <div class="card-body">
            <input id="calendar" type="text" class="form-control" readonly>
        </div>
    </div>
</div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data untuk grafik
        var labels = @json($labels);
        var totalTransaksiData = @json($totalTransaksiData);
        var totalPendapatanData = @json($totalPendapatanData);
        var customerLabels = @json($customerLabels);
        var customerCounts = @json($customerCounts);

        // Grafik Total Pengguna
        new Chart(document.getElementById('userChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengguna',
                    data: Array(labels.length).fill({{ $totalUsers }}),
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        // Grafik Total Transaksi
        new Chart(document.getElementById('transactionChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Transaksi',
                    data: totalTransaksiData,
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        // Grafik Total Pendapatan
        new Chart(document.getElementById('revenueChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: totalPendapatanData,
                    backgroundColor: 'rgba(255, 193, 7, 0.2)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        // Grafik Jumlah Pelanggan
        new Chart(document.getElementById('customerChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: customerLabels,
                datasets: [{
                    label: 'Jumlah Pelanggan',
                    data: customerCounts,
                    backgroundColor: 'rgba(23, 162, 184, 0.2)',
                    borderColor: 'rgba(23, 162, 184, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        // Inisialisasi Flatpickr
        flatpickr("#calendar", {
            inline: true, // Kalender tampil langsung
            dateFormat: "F Y", // Format bulan dan tahun
            defaultDate: "today", // Tanggal default adalah hari ini
        });
    });
</script>

@endsection
