<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin-style.css">
</head>

<body>
    <!-- Login Form -->
    <section class="login-section py-5">
        <div class="container">
            <div class="card mx-auto p-4" style="max-width: 400px;">
                <h3 class="text-center text-primary">Login</h3>
                <form action="#">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <a href="#" class="d-block text-center mt-3 text-secondary">Forgot Password?</a>
                    <p class="text-center mt-3"><a href="admin-registration" class="text-primary">New Account</a>
                    </p>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-3 text-center">
        <p class="text-secondary">© 2024 E Shop. All rights reserved.</p>
    </footer>
</body>

</html>
