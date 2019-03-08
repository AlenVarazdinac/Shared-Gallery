<?php

class GalleryController
{
    // Display gallery
    public function index(){
        if(!Session::getInstance()->isLoggedIn()){
            header('Location: ' . App::config('url') . 'user/login?loginpls');
        }else{
            $view = new View();
            $view->render('gallery/index');
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
}