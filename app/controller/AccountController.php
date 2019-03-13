<?php

class AccountController
{
    // Display account options
    public function index(){
        if(!Session::getInstance()->isLoggedIn()){
            header('Location: ' . App::config('url') . 'user/login?loginpls');
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
            header('Location: ' . App::config('url') . 'account/index?tryagain');
        }else{
            // Get current password from database
            $connection = App::connect();

            $sql = 'SELECT * FROM users WHERE id=:id AND email=:email';

            $stmt = $connection->prepare($sql);
            $stmt->bindParam('id', $user['id']);
            $stmt->bindParam('email', $user['email']);
            $stmt->execute();

            // Store user from DB
            $dbUser = $stmt->fetch(PDO::FETCH_ASSOC);

            if(password_verify($data['currentPassword'], $dbUser['password'])){
                $sql = 'UPDATE users SET password=:password WHERE id=:id AND email=:email';

                $stmt = $connection->prepare($sql);
                $stmt->bindParam('password', password_hash($data['newPassword'], PASSWORD_ARGON2I));
                $stmt->bindParam('id', $dbUser['id']);
                $stmt->bindParam('email', $dbUser['email']);
                $stmt->execute();

                // Unset session
                Session::getInstance()->logout();

                // Redirect to home page
                header('Location: ' . App::config('url') . '?pwchanged');
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
            header('Location: ' . App::config('url') . 'user/login?loginpls');
        }else{
            // Get user's data from Session
            $user = Session::getInstance()->getData();

            // Connect to database
            $connection = App::connect();

            $sql = 'DELETE FROM users WHERE id=:id AND email=:email';
            $stmt = $connection->prepare($sql);
            $stmt->bindParam('id', $user['id']);
            $stmt->bindParam('email', $user['email']);
            $stmt->execute();

            // Remove user's images
            $directory = 'public/gallery_images/' . $user['id'];
            $this->deleteDirectory($directory);

            // Unset session
            Session::getInstance()->logout();
            // Delete cookies
            Cookie::getInstance()->logout();

            // Redirect to home page
            header('Location: ' . App::config('url') . '?accdeleted');
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