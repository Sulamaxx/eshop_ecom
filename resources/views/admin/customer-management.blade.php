@extends('layout.admin-app')

@section('content')
    <div class="container py-5">
        <!-- Search Section -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h4>Customer Management</h4>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchCustomers"
                        placeholder="Search by name, email or status">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customers Table -->
        <div class="my-4">
            <table class="table table-striped pm-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="customerList">
                    <tr>
                        <td>John Doe</td>
                        <td>johndoe@example.com</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                            <button class="btn btn-warning pm-btn-edit">Edit</button>
                            <button class="btn btn-danger pm-btn-delete">Delete</button>
                            <button class="btn btn-secondary pm-btn-toggle-status">Deactivate</button>
                        </td>
                    </tr>
                    <!-- Repeat for other customers -->
                </tbody>
            </table>
        </div>

    </div>
@endsection
