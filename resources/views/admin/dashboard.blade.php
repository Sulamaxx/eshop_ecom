@extends('layout.admin-app')

@section('content')
    <div class="container py-5">
        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Total Products</h5>
                        <p>100</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Total Customers</h5>
                        <p>50</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Active/Inactive Users</h5>
                        <p>5 Active, 2 Inactive</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Manage Products</h5>
                        <button class="btn btn-primary">Add New Product</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Product Management Table -->
        <div class="my-5">
            <h4>Product Management</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Product 1</td>
                        <td>Nike</td>
                        <td>$100</td>
                        <td>20</td>
                        <td>
                            <button class="btn btn-warning">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-secondary">Deactivate</button>
                        </td>
                    </tr>
                    <!-- Repeat for other products -->
                </tbody>
            </table>
        </div>


        <!-- Customer Management Table -->
        <div class="my-5">
            <h4>Customer Management</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>johndoe@example.com</td>
                        <td>Active</td>
                        <td>
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-secondary">Deactivate</button>
                        </td>
                    </tr>
                    <!-- Repeat for other customers -->
                </tbody>
            </table>
        </div>

    </div>
@endsection
