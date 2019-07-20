<div class="container">
    <?php // Successful upload...
    if(Request::get('succupload')):?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-success mt-5">
            <p class="text-center">Image uploaded.</p>
        </div>
    </div>
    <?php endif;?>

    <?php // Successful delete...
    if(Request::get('succdelete')):?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-success mt-5">
            <p class="text-center">Image deleted.</p>
        </div>
    </div>
    <?php endif;?>

    <?php // Something went wrong...
    if(Request::get('tryagain')):?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-danger mt-5">
            <p class="text-center">Something went wrong. Try again.</p>
        </div>
    </div>
    <?php endif;?>

    <?php // Image does not exist...
    if(Request::get('notexist')):?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-danger mt-5">
            <p class="text-center">Image does not exist.</p>
        </div>
    </div>
    <?php endif;?>

    <!-- Image upload -->
    <div class="row mt-5 d-flex justify-content-center">
        <form action="<?php echo Config::getInstance()->getUrl();?>gallery/upload" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="fileUpload"
                    name="gallery[fileUpload]" aria-describedby="fileUploadBtn" accept="image/png,image/jpeg">
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
            <div class="card m-2" style="width: 18rem;">
                <img src="<?php echo Config::getInstance()->getUrl() . 'public/gallery_images/' . $image['uploaded_by'] . '/gallery_' . $image['name'] . '.jpg';?>"
                class="card-img-top" style="height: 26rem;" alt="<?php echo $image['username'];?> image">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?php echo $image['username'];?></li>
                    <li class="list-group-item"><?php echo $image['email'];?></li>
                </ul>
                <?php if($image['userid'] === Session::getInstance()->getData()['id']):?>
                <div class="card-body">
                    <a href="<?php echo Config::getInstance()->getUrl() . 'gallery/remove/' . $image['userid'] . '/' . $image['name'];?>" class="card-link">Remove</a>
                </div>
                <?php endif;?>
            </div>
        <?php endforeach;?>
    </div>
    <!-- Gallery end -->
</div>