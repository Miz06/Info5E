<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Enhanced Bootstrap Carousel</title>
    <style>
        .carousel {
            margin: 5%;
        }

        .carousel img {
            height: 400px;
            width: 80%;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .carousel-caption {
            background-color: lightgrey;
            border-radius: 10px;
            padding: 2%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<?php require './navbar.php'; ?>

<div id="carouselExampleDark" class="carousel carousel-dark slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">

        <div class="carousel-item active" data-bs-interval="10000">
            <img src="./images/img1.jpg" class="d-block w-100" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>First Slide Label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="2000">
            <img src="./images/img1.jpg" class="d-block w-100" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second Slide Label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="./images/img1.jpg" class="d-block w-100" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third Slide Label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
        </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php require './footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>