<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shared Gallery</title>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Style for images counter -->
    <style>
        #images-count-text{
            visibility: hidden;
            font-size: 2rem;
        }
        .toggle-count{
            visibility: visible !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo Config::getInstance()->_url;?>"">Shared Gallery</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo Config::getInstance()->_url; ?>">Home</a>
                </li>
                <?php if (!Session::getInstance()->isLoggedIn()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Config::getInstance()->_url; ?>user/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Config::getInstance()->_url; ?>user/register">Register</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Config::getInstance()->_url; ?>gallery/index">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Config::getInstance()->_url; ?>account/index">My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Config::getInstance()->_url; ?>user/logout">Logout</a>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->

    <?php echo $content;?>

    <!-- Bootstrap Scripts -->
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
    <!-- PopperJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

    <script>
        // Script that counts total images in gallery
        function countImages(){
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200){
                    // Toggle class to count text
                    document.getElementById('images-count-text').classList.toggle('toggle-count');
                    // Set text to response msg
                    document.getElementById('images-number').innerHTML = this.responseText;
                }
            };

            // Async Get Request
            xhttp.open("GET", "gallery/count", true);
            xhttp.send();
        }
    </script>
</body>
</html>