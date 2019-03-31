
<div class="container">

    <?php // You have to be logged in...
    if(isset($_GET['loginpls'])): ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-danger mt-5">
            <p class="text-center">Log in first.</p>
        </div>
    </div>
    <?php endif;?>

    <?php // Successfully registered...
    if(isset($_GET['succreg'])): ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-success mt-5">
            <p class="text-center">Successfully registered. You can log in now.</p>
        </div>
    </div>
    <?php endif;?>

    <?php // Password changed...
    if(isset($_GET['pwchanged'])): ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-success mt-5">
            <p class="text-center">Password changed. Log in using your new password.</p>
        </div>
    </div>
    <?php endif;?>


    <div class="row d-flex justify-content-center align-items-center" style="height: 50vh;">

        <form action="<?php echo Config::getInstance()->getUrl();?>user/authorization"
        method="post" class="col-12 col-md-4">
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email"
                name="email" placeholder="Enter email" value="" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password"
                name="password" placeholder="Password" value="" required>
            </div>

            <!-- Remember me -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="true"
                id="rememberMe" name="rememberMe">
                <label class="form-check-label" for="rememberMe">
                    Remember me
                </label>
            </div>

            <!-- Login button -->
            <button type="submit" class="btn btn-primary mt-3">Login</button>

            <!-- Link to register -->
            <p class="mt-4">Don't have an account? <a href="<?php echo Config::getInstance()->getUrl();?>user/register">Register</a></p>
        </form>
    </div>
</div>