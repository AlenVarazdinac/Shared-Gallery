<?php

class GalleryController
{
    // Display gallery
    public function index(){
        if(!Session::getInstance()->isLoggedIn()){
            header('Location: ' . App::config('url') . 'user/login?loginpls');
        }else{
            // User's gallery directories
            $directories = array_slice(scandir('public/gallery_images/'), 2);
            $images = array();
            $users = array();

            foreach ($directories as $directory) {
                // Connect to database
                $connection = App::connect();

                $sql = 'SELECT id, username, email FROM users WHERE id=:id';
                $stmt = $connection->prepare($sql);
                $stmt->bindParam('id', $directory);
                $stmt->execute();

                // Fetch user
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // "Open" image directory
                $imgDirectory = "public/gallery_images/" . $directory;
                // Get images
                $imagePath = ['images' => glob($imgDirectory . '/*.jpg')];

                // Store images in array
                $images[$directory] = $imagePath;
                // Store users in array
                $images[$directory] += ['user' => $user];
            }
            // Render view with images
            $view = new View();
            $view->render('gallery/index', ['images' => $images, 'users' => $users]);
        }
    }

    // Upload submitted image
    public function upload(){
        $validImage = true;
        if(!Session::getInstance()->isLoggedIn()){
            header('Location: ' . App::config('url') . 'user/login?loginpls');
        }else{
            // If file is uploaded
            if(isset($_FILES["fileUpload"])) {
                // Store file in variable
                $file = getimagesize($_FILES["fileUpload"]["tmp_name"]);

                // Check if file is image (format jpeg or png)
                if($file["mime"] != "image/jpeg" && $file["mime"] != "image/png"){
                    $validImage = false;
                }

                // Upload if image meets requirements
                if($validImage){
                    $userData = Session::getInstance()->getData();
                    $galleryPath = App::config('url') . 'public/gallery_images/';
                    $id = 1;

                    // Check if gallery folder exists for specified user
                    if(!file_exists('public/gallery_images/' . $userData['id'])){
                        mkdir('public/gallery_images/' . $userData['id'], 0755, true);
                    }

                    // Get latest image id
                    $images = array_slice(scandir('public/gallery_images/'. $userData['id']), 2);
                    if(!empty($images)){
                        $lastImage = array_values(array_slice($images, -1))[0];
                        preg_match('/\d/', $lastImage, $lastImageId);
                        $id = $lastImageId[0] + 1;
                    }

                    // Upload new image
                    move_uploaded_file($_FILES["fileUpload"]["tmp_name"],
                    'public/gallery_images/' . $userData['id'] . '/gallery_' . $id . '.jpg');

                    // Redirect back to gallery
                    header('Location: ' . App::config('url') . 'gallery/index?succupload');
                }else{
                    // Redirect back to gallery
                    header('Location: ' . App::config('url') . 'gallery/index?tryagain');
                }
            }
        }
    }

    // Remove image
    public function remove($data){
        $userId = $data[0];
        $imageId = $data[1];

        if(!Session::getInstance()->isLoggedIn()){
            header('Location: ' . App::config('url') . 'user/login?loginpls');
        }else{
            $image = 'public/gallery_images/' . $userId . '/' . $imageId . '.jpg';
            $directory = 'public/gallery_images/' . $userId;

            // Delete image if exists
            if(file_exists($image)){
                unlink($image);

                // Delete directory where image was if directory is empty
                if($this->isDirectoryEmpty($directory)){
                    rmdir($directory);
                }

                // Redirect back to gallery
                header('Location: ' . App::config('url') . 'gallery/index?succdelete');
            }else{
                header('Location: ' . App::config('url') . 'gallery/index?notexist');
            }
        }
    }

    /**
     * Check if a directory is empty
     *
     * @param string $dirname
     * @return bool
     */
    function isDirectoryEmpty($directory){
        if(!is_dir($directory)){
            return false;
        }

        foreach(scandir($directory) as $file){
            if(!in_array($file, array('.', '..'))){
                return false;
            }
        }

        return true;
    }

    // Count images for Home page
    function count(){
        // Gallery path
        $directory = 'public/gallery_images/';
        // Counter
        $filesCounted = 0;

        // Connect to database to get user IDs
        $connection = App::connect();
        $sql = 'SELECT id FROM users';
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        // Fetch user ids
        $userIds = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Iterate through user's directories and count images
        foreach ($userIds as $userId) {
            // Check if directory exists
            if(!file_exists($directory . $userId['id'])){
                continue;
            }

            // Count images
            $fileIterator = new FilesystemIterator($directory . $userId['id'], FilesystemIterator::SKIP_DOTS);
            $filesCounted += iterator_count($fileIterator);
        }

        // Return count message
        echo $filesCounted;
    }
}