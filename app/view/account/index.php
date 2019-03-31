<div class="container">

    <?php // Something went wrong...
    if(isset($_GET['tryagain'])): ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-danger mt-5">
            <p class="text-center">Something went wrong. Try again.</p>
        </div>
    </div>
    <?php endif;?>

    <div class="row d-flex justify-content-center align-items-center" style="height: 50vh;">
        <!-- Change password form -->
        <div class="col-12 col-md-6">
            <form action="<?php echo Config::getInstance()->getUrl();?>account/pwchange"
            method="post">
                <!-- Current password -->
                <div class="form-group">
                    <label for="currentPassword">Current password</label>
                    <input type="password" class="form-control" id="currentPassword"
                    name="currentPassword" placeholder="Enter current password" value="" required>
                </div>

                <!-- New password -->
                <div class="form-group">
                    <label for="newPassword">New password</label>
                    <input type="password" class="form-control" id="newPassword"
                    name="newPassword" placeholder="New password" value="" required>
                </div>

                <!-- Repeat new password -->
                <div class="form-group">
                    <label for="repeatPassword">Repeat password</label>
                    <input type="password" class="form-control" id="repeatPassword"
                    name="repeatPassword" placeholder="Repeat new password" value="" required>
                </div>

                <!-- Login button -->
                <button type="submit" class="btn btn-primary">Change password</button>
            </form>
        </div>
        <!-- Change password form end -->

        <!-- Delete account -->
        <div class="col-12 col-md-6 d-flex flex-column align-middle justify-content-center align-items-center">
                <p class="font-weight-bold text-uppercase mr-4">Would you like to delete your account?</p>
                <a class="btn btn-danger" href="<?php echo Config::getInstance()->getUrl();?>account/delete">Delete</a>
        </div>
        <!-- Delete account end -->
    </div>
</div>