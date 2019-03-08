<?php
    Cookie::getInstance()->rememberMeData();
?>
<div class="container">
    <div class="row d-flex justify-content-center align-items-center" style="height: 75vh;">
        <form action="<?php echo App::config('url');?>user/authorization"
        method="post" class="col-12 col-md-4">
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
            <p class="mt-4">Don't have an account? <a href="<?php echo App::config('url');?>user/register">Register</a></p>
        </form>
    </div>
</div>