@extends('layouts.app')

@section('content')
<h1>Transaksi Kasir</h1>

<!-- Tampilkan Pesan Sukses atau Error -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Form Input -->
<input type="hidden" name="penggunaID" value="{{ $pengguna->id }}">
<p>Kasir: {{ $pengguna->Nama }}</p>

<!-- Form Transaksi -->
<form id="transactionForm" action="{{ route('transactions.store') }}" method="POST">
    @csrf

    <!-- Input Manual untuk Customer -->
    <div class="mb-3">
        <label for="customer_name" class="form-label">Nama Customer:</label>
        <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Masukkan nama customer" required>
    </div>

    <div class="mb-3">
        <label for="customer_email" class="form-label">Email Customer (Opsional):</label>
        <input type="email" id="customer_email" name="customer_email" class="form-control" placeholder="Masukkan email customer">
    </div>

    <div class="mb-3">
        <label for="customer_phone" class="form-label">Nomor Telepon (Opsional):</label>
        <input type="text" id="customer_phone" name="customer_phone" class="form-control" placeholder="Masukkan nomor telepon">
    </div>

    <!-- Tambahkan Barang -->
    <div class="mb-3">
        <label for="barang" class="form-label">Pilih Barang:</label>
        <select id="barang" class="form-select">
            <option value="" disabled selected>-- Pilih Barang --</option>
            @foreach ($barangs as $barang)
                <option value="{{ $barang->BarangID }}" data-price="{{ $barang->Harga_jual }}">
                    {{ $barang->Nama_barang }} - Rp {{ number_format($barang->Harga_jual, 0, ',', '.') }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Jumlah:</label>
        <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="1" required>
    </div>

    <button type="button" id="addItem" class="btn btn-primary mb-3">Tambahkan Barang</button>

    <!-- Daftar Barang -->
    <h3>Daftar Belanja</h3>
    <table class="table table-bordered" id="cart">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Item akan ditambahkan di sini -->
        </tbody>
    </table>

    <!-- Total Harga -->
    <h3>Total: Rp <span id="totalPrice">0</span></h3>
    <input type="hidden" name="total_harga" id="totalHargaInput">

    <div class="mb-3">
        <label for="cash_given" class="form-label">Nominal Uang yang Diberikan:</label>
        <input type="number" id="cash_given" name="cash_given" class="form-control" placeholder="Masukkan nominal uang pembeli" required>
    </div>

    <div class="mb-3">
        <label for="change" class="form-label">Kembalian:</label>
        <input type="text" id="change" class="form-control" readonly>
    </div>

    <!-- Pilih Diskon -->
    <label for="diskon">Pilih Diskon:</label>
    <select name="diskon_id" id="diskon" class="form-select">
        <option value="">Tidak Ada Diskon</option>
        @foreach($diskons as $diskon)
            <option value="{{ $diskon->id }}" data-diskon="{{ $diskon->besar_diskon }}">
                {{ $diskon->nama_diskon }} ({{ $diskon->besar_diskon }}%) - Berlaku hingga {{ $diskon->jangka_waktu }} hari
            </option>
        @endforeach
    </select>

    <!-- Simpan Transaksi -->
    <button type="submit" class="btn btn-success">Simpan Transaksi</button>
</form>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cart = document.querySelector('#cart tbody');
    const barangSelect = document.getElementById('barang');
    const quantityInput = document.getElementById('quantity');
    const totalPriceElement = document.getElementById('totalPrice');
    const totalHargaInput = document.getElementById('totalHargaInput');
    const addItemButton = document.getElementById('addItem');
    const cashGivenInput = document.getElementById('cash_given');
    const changeInput = document.getElementById('change');
    const diskonSelect = document.getElementById('diskon');

    let total = 0;

    // Tambahkan Barang ke Daftar
    addItemButton.addEventListener('click', function () {
        const selectedOption = barangSelect.options[barangSelect.selectedIndex];
        const barangID = selectedOption.value;
        const barangName = selectedOption.textContent.split(' - ')[0];
        const price = parseFloat(selectedOption.getAttribute('data-price'));
        const quantity = parseInt(quantityInput.value);

        if (!barangID) {
            alert('Pilih barang terlebih dahulu!');
            return;
        }

        if (quantity <= 0) {
            alert('Masukkan jumlah barang yang valid!');
            return;
        }

        // Periksa apakah barang sudah ada di keranjang
        const existingRow = Array.from(cart.querySelectorAll('tr')).find(row => {
            return row.querySelector('input[name="barang_id[]"]').value === barangID;
        });

        if (existingRow) {
            const existingQuantityInput = existingRow.querySelector('input[name="quantity[]"]');
            const newQuantity = parseInt(existingQuantityInput.value) + quantity;

            existingQuantityInput.value = newQuantity;
            existingRow.querySelector('td:nth-child(3)').textContent = newQuantity;
            const newSubtotal = price * newQuantity;
            existingRow.querySelector('td:nth-child(4)').textContent = `Rp ${newSubtotal.toLocaleString()}`;

            total += price * quantity;
            totalPriceElement.textContent = total.toLocaleString();
            totalHargaInput.value = total;

            return;
        }

        // Tambahkan barang ke tabel jika belum ada
        const subtotal = price * quantity;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <input type="hidden" name="barang_id[]" value="${barangID}">
                ${barangName}
            </td>
            <td>Rp ${price.toLocaleString()}</td>
            <td>
                <input type="hidden" name="quantity[]" value="${quantity}">
                ${quantity}
            </td>
            <td>Rp ${subtotal.toLocaleString()}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm removeItem">Hapus</button>
            </td>
        `;
        cart.appendChild(row);

        total += subtotal;
        totalPriceElement.textContent = total.toLocaleString();
        totalHargaInput.value = total;

        barangSelect.selectedIndex = 0;
        quantityInput.value = 1;
    });

    // Hitung Diskon
    diskonSelect.addEventListener('change', function () {
        const selectedOption = diskonSelect.options[diskonSelect.selectedIndex];
        const diskon = parseFloat(selectedOption.getAttribute('data-diskon')) || 0;

        const totalHarga = parseFloat(totalHargaInput.value) || 0;
        const totalSetelahDiskon = totalHarga - (totalHarga * diskon / 100);

        totalPriceElement.textContent = totalSetelahDiskon.toLocaleString();
        totalHargaInput.value = totalSetelahDiskon;
    });

    // Hitung Kembalian
    cashGivenInput.addEventListener('input', function () {
        const cashGiven = parseFloat(cashGivenInput.value) || 0;
        const totalHarga = parseFloat(totalHargaInput.value) || 0;
        const change = cashGiven - totalHarga;

        changeInput.value = change >= 0 ? `Rp ${change.toLocaleString()}` : 'Nominal tidak cukup';
    });

    // Hapus Barang dari Daftar
    cart.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeItem')) {
            const row = e.target.closest('tr');
            const subtotal = parseFloat(row.querySelector('td:nth-child(4)').textContent.replace(/[^\d]/g, ''));

            total -= subtotal;
            totalPriceElement.textContent = total.toLocaleString();
            totalHargaInput.value = total;

            row.remove();
        }
    });

    // Validasi sebelum submit
    document.getElementById('transactionForm').addEventListener('submit', function (e) {
        const cashGiven = parseFloat(cashGivenInput.value) || 0;
        const totalHarga = parseFloat(totalHargaInput.value) || 0;

        if (cashGiven < totalHarga) {
            e.preventDefault();
            alert('Nominal uang yang diberikan kurang dari total harga!');
        }
    });
});
</script>
@endsection
