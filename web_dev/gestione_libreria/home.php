<?php
$title = 'Home';
require './navbar.php';
require './footer.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<link href="./style.css" rel="stylesheet">

<div id="carouselExampleDark" class="carousel carousel-dark slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">

        <div class="carousel-item active" data-bs-interval="10000">
            <img src="./images/mySQL.png" class="d-block w-100" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>mySQL</h5>
                <p>MySQL è un sistema di gestione di database relazionali open source indipendente dalla piattaforma e che offre innumerevoli usi e funzionalità.</p>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="2000">
            <img src="./images/xampp.png" class="d-block w-100" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>XAMPP</h5>
                <p>XAMPP è una distribuzione di Apache completamente gratuita e semplice da installare, contenente MySQL, PHP e Perl.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="./images/php.jpg" class="d-block w-100" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>PHP</h5>
                <p>Il PHP permette l'elaborazione di dati da base di dati MySQL. I dati verranno richiesti, inseriti e modificati attraverso opportune query usando alcune estensioni tra cui MySQL e PDO.</p>
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
