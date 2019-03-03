<div class="container">
    <div class="row d-flex justify-content-center align-items-center" style="height: 75vh;">
        <form action="<?php echo App::config('url');?>user/registration" method="post" class="col-12 col-md-4">
            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username"
                name="username" placeholder="Enter username">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email"
                name="email" placeholder="Enter email">
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password"
                name="password" placeholder="Password">
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword"
                name="confirmPassword" placeholder="Password">
            </div>

            <!-- Register button -->
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>