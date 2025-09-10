@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Customers</h2>

    <!-- Search Form -->
    <form method="GET" action="{{ route('customers.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Cari nama, email, atau no HP" value="{{ request()->get('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Table displaying customer data -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->CustomerID }}</td>
                <td>{{ $customer->nama }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->no_hp }}</td>
                <td>
                    <!-- Button to trigger View Details modal -->
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#customerModal" data-customer="{{ $customer }}">View Details</button>
                    <!-- Button to trigger Edit modal -->
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCustomerModal" data-customer="{{ $customer }}">Edit</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for viewing customer details -->
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">Customer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="customerDetails">
                        <!-- Customer details will be inserted here dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing customer -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCustomerForm" method="POST" action="{{ route('customers.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="customerId" name="customerId">

                        <div class="mb-3">
                            <label for="editCustomerName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editCustomerName" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCustomerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editCustomerEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="editCustomerPhone" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="editCustomerPhone" name="no_hp">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to populate View Details modal with customer data
    const customerModal = document.getElementById('customerModal');
    customerModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const customer = button.getAttribute('data-customer');
        const customerDetailsDiv = document.getElementById('customerDetails');
        
        const customerData = JSON.parse(customer);
        
        customerDetailsDiv.innerHTML = `
            <p><strong>ID:</strong> ${customerData.CustomerID}</p>
            <p><strong>Nama:</strong> ${customerData.nama}</p>
            <p><strong>Email:</strong> ${customerData.email}</p>
            <p><strong>No HP:</strong> ${customerData.no_hp}</p>
        `;
    });

    // JavaScript to populate Edit modal with customer data
    const editCustomerModal = document.getElementById('editCustomerModal');
    editCustomerModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const customer = button.getAttribute('data-customer');
        const customerData = JSON.parse(customer);

        // Set form inputs to the customer data
        document.getElementById('customerId').value = customerData.CustomerID;
        document.getElementById('editCustomerName').value = customerData.nama;
        document.getElementById('editCustomerEmail').value = customerData.email;
        document.getElementById('editCustomerPhone').value = customerData.no_hp;
    });
</script>
@endsection
