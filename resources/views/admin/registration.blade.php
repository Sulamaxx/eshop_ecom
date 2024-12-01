<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin-style.css">
</head>

<body>
    <!-- Registration Section -->
    <section class="registration-section py-5">
        <div class="container">
            <div class="card mx-auto p-4" style="max-width: 500px;">
                <h3 class="text-center text-primary">Create an Account</h3>
                <form action="#">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" placeholder="Enter your first name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" placeholder="Enter your last name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control" id="contact"
                            placeholder="Enter your contact number">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password"
                            placeholder="Confirm your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
                <p class="text-center mt-3">Already have an account? <a href="admin-login"
                        class="text-primary">Login</a>
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-3 text-center">
        <p class="text-secondary">© 2024 E Shop. All rights reserved.</p>
    </footer>
</body>

</html>
