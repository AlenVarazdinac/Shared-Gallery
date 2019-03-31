<?php

class AccountController
{
    // Display account options
    public function index(){
        if(!Session::getInstance()->isLoggedIn()){
            RedirectController::redirectTo('user/login?loginpls');
        }else{
            $view = new View();
            $view->render('account/index');
        }
    }

    // Change password
    public function pwChange(){
        // Store submitted data and validate
        $data = $this->_validatePassword($_POST);
        // Store data from current user session
        $user = Session::getInstance()->getData();

        if($data === false){
            RedirectController::redirectTo('account/index?tryagain');
        }else{
            $account = new Account();
            $getPassword = $account->getPassword($user);

            // If current user's password and current given password match then change password
            if(password_verify($data['currentPassword'], $getPassword['password'])){
                $newPassword = $account->changePassword($data, $getPassword);

                // Unset session & Cookie
                Session::getInstance()->logout();
                Cookie::getInstance()->logout();

                // Redirect to home page
                RedirectController::redirectTo('user/login?pwchanged');
            }else{
                RedirectController::redirectTo('account/index?tryagain');
            }
        }
    }

    /**
     * Validate registration
     * @param $data
     * @return array|bool
     */
    public function _validatePassword($data){
        $required = ['currentPassword', 'newPassword', 'repeatPassword'];

        $data = array_diff_key($data, $required);

        // Validate required keys
        foreach($required as $key){
            if(!isset($data[$key])) {
                return false;
            }

            if(empty($data[$key])){
                return false;
            }

            $data[$key] = htmlspecialchars($data[$key], ENT_QUOTES);
        }

        // Check if passwords match
        if($data['newPassword'] !== $data['repeatPassword']){
            return false;
        }

        return $data;
    }

    // Delete user's account
    public function delete(){
        if(!Session::getInstance()->isLoggedIn() && Session::getInstance()->getData() === ''){
            RedirectController::redirectTo('user/login?loginpls');
        }else{
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
            RedirectController::redirectTo('?accdeleted');
        }
    }

    // Delete user's gallery
    function deleteDirectory($dir) {
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