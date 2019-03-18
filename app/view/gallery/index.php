<div class="container">

    <?php // Successful upload...
    if(isset($_GET['succupload'])): ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-success mt-5">
            <p class="text-center">Image uploaded.</p>
        </div>
    </div>
    <?php endif;?>

    <?php // Successful delete...
    if(isset($_GET['succdelete'])): ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-success mt-5">
            <p class="text-center">Image deleted.</p>
        </div>
    </div>
    <?php endif;?>

    <?php // Something went wrong...
    if(isset($_GET['tryagain'])): ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-danger mt-5">
            <p class="text-center">Something went wrong. Try again.</p>
        </div>
    </div>
    <?php endif;?>

    <?php // Image does not exist...
    if(isset($_GET['notexist'])): ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-danger mt-5">
            <p class="text-center">Image does not exist.</p>
        </div>
    </div>
    <?php endif;?>

    <!-- Image upload -->
    <div class="row mt-5 d-flex justify-content-center">
        <form action="<?php echo App::config('url');?>gallery/upload" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="fileUpload"
                    name="fileUpload" aria-describedby="fileUploadBtn" accept="image/png,image/jpeg">
                    <label class="custom-file-label" for="fileUpload">Choose file</label>
                </div>
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit" id="fileUploadBtn" name="submit" value="submit" />
                </div>
            </div>
        </form>
    </div>
    <!-- Image upload end -->

    <!-- Gallery -->
    <div class="row mt-5 d-flex justify-content-center">
        <?php foreach($images as $image): ?>
            <?php foreach($image['images'] as $imagePath):?>
                <?php
                $imgLink = substr($imagePath, 0, strpos($imagePath, '.jpg'));
                $imgLink = strstr($imgLink, $image['user']['id']);
                ?>

                <div class="card m-2" style="width: 18rem;">
                    <img src="<?php echo App::config('url') . $imagePath;?>"
                    class="card-img-top" style="height: 26rem;" alt="<?php echo $image['user']['username'];?> image">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo $image['user']['username'];?></li>
                        <li class="list-group-item"><?php echo $image['user']['email'];?></li>
                    </ul>
                    <?php if($image['user']['id'] === Session::getInstance()->getData()['id']):?>
                    <div class="card-body">
                        <a href="<?php echo App::config('url') . 'gallery/remove/' . $imgLink;?>" class="card-link">Remove</a>
                    </div>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        <?php endforeach;?>
    </div>
    <!-- Gallery end -->
</div>