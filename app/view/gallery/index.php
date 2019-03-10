<div class="container">
    <!-- Image upload -->
    <div class="row mt-5">
        <form action="<?php echo App::config('url');?>gallery/upload"
        method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input"
                    id="fileUpload" name="fileUpload" aria-describedby="fileUploadBtn"
                    accept="image/png,image/jpeg">
                    <label class="custom-file-label" for="fileUpload">Choose file</label>
                </div>
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit"
                    id="fileUploadBtn" name="submit" value="submit"/>
                </div>
            </div>
        </form>
    </div>
    <!-- Image upload end -->

    <!-- Gallery -->
    <div class="row mt-5">
        <?php foreach($images as $image): ?>
            <img src="<?php echo App::config('url') . $image;?>" />
        <?php endforeach;?>
    </div>
    <!-- Gallery end -->
</div>