@extends('layout.admin-app')

@section('content')
    <div class="container py-5">
        <h4>Order Management</h4>

        <!-- Order Management Table -->
        <div class="my-5">
            <h5>Placed Orders</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example order row -->
                    <tr>
                        <td>#12345</td>
                        <td>John Doe</td>
                        <td>$200</td>
                        <td>
                            <span class="badge badge-warning">Packing</span>
                        </td>
                        <td>
                            <button class="btn btn-success order-action-btn" data-order-id="12345"
                                data-status="Delivered">Delivered</button>
                            <button class="btn btn-primary order-action-btn" data-order-id="12345"
                                data-status="Completed">Completed</button>
                        </td>
                    </tr>
                    <!-- Repeat for other orders -->
                </tbody>
            </table>
        </div>

        <!-- Order Details Modal -->
        <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Order details content will be injected here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
