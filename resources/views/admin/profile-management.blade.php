@extends('layout.admin-app')

@section('content')
    <div class="container py-5">
        <h4>Profile Management</h4>

        <!-- Profile Edit Form -->
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card pm-card">
                    <div class="card-body">
                        <form action="#" method="POST" id="profile-form">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control pm-input" id="firstName" value="John">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control pm-input" id="lastName" value="Doe">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control pm-input" id="email"
                                    value="johndoe@example.com">
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control pm-input" id="contact" value="123-456-7890">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control pm-input" id="password" value="password123">
                            </div>

                            <button type="submit" class="btn btn-primary pm-btn-save">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
