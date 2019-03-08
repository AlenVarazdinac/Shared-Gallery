<div class="container">
    <div class="row d-flex justify-content-center align-items-center" style="height: 75vh;">
        <form action="<?php echo App::config('url');?>user/registration"
        method="post" class="col-12 col-md-4">
            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username"
                name="username" placeholder="Enter username" value="">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email"
                name="email" placeholder="Enter email" value="">
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password"
                name="password" placeholder="Password" value="">
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword"
                name="confirmPassword" placeholder="Password" value="">
            </div>

            <!-- Register button -->
            <button type="submit" class="btn btn-primary">Register</button>

            <!-- Link to login -->
            <p class="mt-4">Already have an account? <a href="<?php echo App::config('url');?>user/login">Login</a></p>

        </form>
    </div>
</div>