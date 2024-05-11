<?php


require_once "inc/functions.inc.php";


if (empty($_SESSION['user'])) {

    header("location:".RACINE_SITE."authentification.php");

// }else if (!empty($_SESSION['user'])) {

//     header("location:".RACINE_SITE."index.php");

}else if($_SESSION['user'] ['role'] == 'ROLE_ADMIN') {

    header("location:".RACINE_SITE."admin/dashboard.php?dashboard_php");
}

$title = "Profil";
require_once "inc/header.inc.php";
?>


<main>
    
    <div class = "carousel1">
    <h2 class="text-center">Bonjour <?=$_SESSION['user']['nom']?></h2>
    <div id="carouselExampleCaptions" class=" container carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="./assets/img/livre2.jpg" class="d-block w-25" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Promotion pour vous 30% </h5>
                <p>Vous avez 40 points sur votre achat.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="./assets/img/livre3.jpg" class="d-block w-25" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Promotion pour vous 10%</h5>
                <p>Vous avez 40 points sur votre achat.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="./assets/img/livre1.jpg" class="d-block w-25" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Promotion pour vous 10%</h5>
                <p>Vous avez 40 points sur votre achat.</p>
            </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    </div>
</main>






<?php
require_once "inc/footer.inc.php";

?>