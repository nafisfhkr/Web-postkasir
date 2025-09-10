<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .receipt { width: 400px; margin: auto; border: 1px solid #ddd; padding: 20px; }
        .header { text-align: center; }
        .items th, .items td { padding: 8px; text-align: left; }
        .total { text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h2>Toko IndoApril</h2>
            <p>Jl. Jalani Dulu No. 22</p>
        </div>
        <hr>
        <p><strong>Nama Pelanggan:</strong> {{ $transactions->customer->nama }}</p>
        <p><strong>Tanggal Transaksi:</strong> {{ $transactions->Tanggal_transaksi }}</p>
        <p><strong>No Transaksi:</strong> {{ $transactions->TransaksiID }}</p>
        <p><strong>Kasir:</strong> {{ $transactions->pengguna->Nama }}</p> <!-- Menampilkan nama kasir -->
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <th>Diskon</th>
                    <th>Total Setelah Diskon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions->detailTransactions as $detail)
                    <tr>
                        <td>{{ $detail->barang->Nama_barang }}</td>
                        <td>{{ $detail->Jumlah_barang }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->Subtotal, 0, ',', '.') }}</td>
                        <td>{{ $detail->diskon }}%</td>
                        <td>
                            Rp {{ number_format($detail->Subtotal - ($detail->Subtotal * $detail->diskon / 100), 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr>
        <p class="total">Total Diskon: Rp {{ number_format($transactions->diskon, 0, ',', '.') }}</p>
        <p class="total">Total Setelah Diskon: Rp {{ number_format($transactions->total_harga, 0, ',', '.') }}</p>
        <p><strong>Nominal Uang Diberikan:</strong> Rp {{ number_format($transactions->cash_given, 0, ',', '.') }}</p>
        <p><strong>Kembalian:</strong> Rp {{ number_format($transactions->cash_given - $transactions->total_harga, 0, ',', '.') }}</p>

        <hr>
        <p>Terima kasih telah berbelanja!</p>
    </div>
    <script>
    window.onload = function () {
        window.print(); 
    }
    </script>
</body>
</html>
