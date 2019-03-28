<div class="container">
    <?php // Account deleted...
    if(isset($_GET['accdeleted'])): ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 align-middle alert alert-success mt-5">
            <p class="text-center">Your account is successfully deleted.</p>
        </div>
    </div>
    <?php endif;?>

    <div class="row d-flex flex-column justify-content-center align-items-center" style="height: 50vh;">
        <p id="images-count-text">Total images in gallery: <span id="images-number"></span></p>
        <button class="btn btn-primary" id="count-images" type="button" onclick="countImages()">Count images</button>
    </div>
</div>