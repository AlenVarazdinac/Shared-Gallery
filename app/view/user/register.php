<div class="container">

    <?php // Wrong input...
    if(Request::get('tryagain')):?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-danger mt-5">
            <p class="text-center">Something went wrong, try again.</p>
        </div>
    </div>
    <?php endif;?>


    <div class="row d-flex justify-content-center align-items-center" style="height: 50vh;">
        <form action="<?php echo Config::getInstance()->_url;?>user/registration"
        method="post" class="col-12 col-md-4">
            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username"
                name="user[username]" placeholder="Enter username" value="" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email"
                name="user[email]" placeholder="Enter email" value="" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password"
                name="user[password]" placeholder="Password" value="" required>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword"
                name="user[confirmPassword]" placeholder="Password" value="" required>
            </div>

            <!-- Register button -->
            <button type="submit" class="btn btn-primary">Register</button>

            <!-- Link to login -->
            <p class="mt-4">Already have an account? <a href="<?php echo Config::getInstance()->_url;?>user/login">Login</a></p>

        </form>
    </div>
</div>