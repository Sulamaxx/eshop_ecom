<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E Shop Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin-styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-dark text-white p-4" id="sidebar">
            <h3 class="mb-5">Admin Panel</h3>
            <ul class="list-unstyled">
                <li><a href="admin-dashboard" class="text-white">Dashboard</a></li>
                <li><a href="product-management" class="text-white">Products</a></li>
                <li><a href="customer-management" class="text-white">Customers</a></li>
                <li><a href="order-management" class="text-white">Orders</a></li>
                <li><a href="admin-profile" class="text-white">Profile</a></li>
            </ul>
        </div>

        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <span class="navbar-brand">E Shop Admin</span>
                    <button class="btn btn-outline-secondary" id="mode-toggle">Light/Dark Mode</button>
                    <button class="btn btn-outline-primary d-lg-none" id="menu-toggle">
                        <i class="fas fa-bars"></i> Menu
                    </button>
                    <div class="ml-auto">
                        <button class="btn btn-danger">Logout</button>
                    </div>
                </div>
            </nav>

            @yield('content')

        </div>
    </div>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin-script.js"></script>
    @stack('scripts')

</body>

</html>
