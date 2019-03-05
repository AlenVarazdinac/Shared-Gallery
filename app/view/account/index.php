<div class="container">
    <div class="row d-flex justify-content-center align-items-center" style="height: 75vh;">
        <!-- Change password form -->
        <div class="col-12 col-md-6">
            <form action="<?php echo App::config('url');?>account/pwchange"
            method="post">
                <!-- Current password -->
                <div class="form-group">
                    <label for="currentPassword">Current password</label>
                    <input type="password" class="form-control" id="currentPassword"
                    name="currentPassword" placeholder="Enter current password" value="">
                </div>

                <!-- New password -->
                <div class="form-group">
                    <label for="newPassword">New password</label>
                    <input type="password" class="form-control" id="newPassword"
                    name="newPassword" placeholder="New password" value="">
                </div>

                <!-- Repeat new password -->
                <div class="form-group">
                    <label for="repeatPassword">Password</label>
                    <input type="password" class="form-control" id="repeatPassword"
                    name="repeatPassword" placeholder="Repeat new password" value="">
                </div>

                <!-- Login button -->
                <button type="submit" class="btn btn-primary">Change password</button>
            </form>
        </div>
        <!-- Change password form end -->

        <!-- Delete account -->
        <div class="col-12 col-md-6 d-flex flex-column align-middle justify-content-center align-items-center">
                <p class="font-weight-bold text-uppercase mr-4">Would you like to delete your account?</p>
                <a class="btn btn-danger" href="<?php echo App::config('url');?>account/delete">Delete</a>
        </div>
        <!-- Delete account end -->
    </div>
</div>