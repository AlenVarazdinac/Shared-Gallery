<?php

/**
 * Account controller
 */
class AccountController
{
    /**
     * Display account options
     *
     * @return void
     */
    public function index()
    {
        if (!Session::getInstance()->isLoggedIn()) {
            RedirectController::redirectTo('user/login?loginpls=true');
        } else {
            $view = new View();
            $view->render('account/index');
        }
    }

    /**
     * Change password
     *
     * @return void
     */
    public function pwChange()
    {
        // Store submitted data and validate
        $data = $this->_validatePassword(Request::post('account'));

        // Store data from current user session
        $user = Session::getInstance()->getData();

        if ($data === false) {
            RedirectController::redirectTo('account/index?tryagain=true');
        } else {
            $account = new Account();
            $getPassword = $account->getPassword($user);

            // If current user's password and current
            // given password match then change password
            if (password_verify($data['currentPassword'], $getPassword['password'])) {
                $newPassword = $account->changePassword($data, $getPassword);

                // Unset session & Cookie
                Session::getInstance()->logout();
                Cookie::getInstance()->logout();

                // Redirect to home page
                RedirectController::redirectTo('user/login?pwchanged=true');
            } else {
                RedirectController::redirectTo('account/index?tryagain=true');
            }
        }
    }

    /**
     * Validate registration
     *
     * @param mixed $data form data
     *
     * @return array|bool
     */
    private function _validatePassword($data)
    {
        $required = ['currentPassword', 'newPassword', 'repeatPassword'];

        $data = array_diff_key($data, $required);

        // Validate required keys
        foreach ($required as $key) {
            if (!isset($data[$key])) {
                return false;
            }

            if (empty($data[$key])) {
                return false;
            }

            $data[$key] = htmlspecialchars($data[$key], ENT_QUOTES);
        }

        // Check if passwords match
        if ($data['newPassword'] !== $data['repeatPassword']) {
            return false;
        }

        return $data;
    }

    /**
     * Delete user's account
     *
     * @return void
     */
    public function delete()
    {
        if (!Session::getInstance()->isLoggedIn()
            && Session::getInstance()->getData() === ''
        ) {
            RedirectController::redirectTo('user/login?loginpls=true');
        } else {
            // Get user's data from Session
            $user = Session::getInstance()->getData();

            $account = new Account();
            $account->deleteAccount($user);

            // Remove user's images
            $directory = 'public/gallery_images/' . $user['id'];
            $this->deleteDirectory($directory);

            // Unset session
            Session::getInstance()->logout();
            // Delete cookies
            Cookie::getInstance()->logout();

            // Redirect to home page
            RedirectController::redirectTo('?accdeleted=true');
        }
    }

    /**
     * Delete user's gallery
     *
     * @param mixed $dir gallery directory
     *
     * @return void
     */
    function deleteDirectory($dir)
    {
        // Iterate through files
        foreach (glob($dir) as $file) {
            if (is_dir($file)) {
                // Remove directory once empty
                self::deleteDirectory("$file/*");
                rmdir($file);
            } else {
                // Remove if file
                unlink($file);
            }
        }
    }

}