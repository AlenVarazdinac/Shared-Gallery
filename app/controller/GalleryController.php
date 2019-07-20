<?php

class GalleryController
{
    // Display gallery
    public function index(){
        if(!Session::getInstance()->isLoggedIn()){
            RedirectController::redirectTo('user/login?loginpls=true');
        }else{
            // Get images
            $gallery = new Gallery();
            $gallery = $gallery->showImages();

            // Render view with images
            $view = new View();
            $view->render('gallery/index', ['images' => $gallery]);
        }
    }

    // Upload submitted image
    public function upload(){
        $validImage = true;
        if(!Session::getInstance()->isLoggedIn()){
            RedirectController::redirectTo('user/login?loginpls=true');
        }else{
            // Get uploaded file
            $filesData = Request::files('gallery');
            // If file is uploaded
            if($filesData['error']['fileUpload'] == 0) {
                // Store file in variable
                $file = getimagesize($filesData["tmp_name"]["fileUpload"]);

                // Check if file is image (format jpeg or png)
                if($file["mime"] != "image/jpeg" && $file["mime"] != "image/png"){
                    $validImage = false;
                }

                // Upload if image meets requirements
                if($validImage){
                    // Get current user data
                    $userData = Session::getInstance()->getData();

                    // Instance gallery
                    $gallery = new Gallery();

                    // Start Image ID
                    $imageId = 1;

                    // Check if gallery folder exists for specified user
                    if(!file_exists('gallery_images/' . $userData['id'])){
                        mkdir('gallery_images/' . $userData['id'], 0755, true);
                    }

                    // Get latest image id
                    if(!empty($gallery->getLastImage($userData['id']))){
                        $imageId = $gallery->getLastImage($userData['id'])['name'];
                        $imageId++;
                    }

                    // Upload new image
                    move_uploaded_file($filesData["tmp_name"]["fileUpload"],
                    'gallery_images/' . $userData['id'] . '/gallery_' . $imageId . '.jpg');

                    // Upload to Database
                    $gallery->dbUpload($userData['id'], $imageId);

                    // Redirect back to gallery
                    RedirectController::redirectTo('gallery/index?succupload=true');
                }else{
                    // Redirect back to gallery
                    RedirectController::redirectTo('gallery/index?tryagain=true');
                }
            }
        }
    }

    // Remove image
    public function remove($data){
        $userId = $data[0];
        $imageName = $data[1];

        $gallery = new Gallery();

        if(!Session::getInstance()->isLoggedIn()){
            RedirectController::redirectTo('user/login?loginpls=true');
        }else{
            $image = 'gallery_images/' . $userId . '/gallery_' . $imageName . '.jpg';
            $directory = 'gallery_images/' . $userId;

            // Delete image if exists
            if(file_exists($image)){
                unlink($image);

                // Delete from database
                $gallery->dbDelete($userId, $imageName);

                // Delete directory where image was if directory is empty
                if($this->isDirectoryEmpty($directory)){
                    rmdir($directory);
                }

                // Redirect back to gallery
                RedirectController::redirectTo('gallery/index?succdelete=true');
            }else{
                RedirectController::redirectTo('gallery/index?notexist=true');
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
        $filesCounted = 0;

        $gallery = new Gallery();
        $filesCounted = $gallery->countImages();

        // Return count message
        echo $filesCounted;
    }
}