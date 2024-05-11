<?php

// require_once "functions.inc.php";






$title = "apropos";
require_once "inc/header.inc.php";
?>


<section class="container-fluid aproposImg d-flex justify-content-around">
    <div>
        <h1 class="text-light mt-4">A Propos de Nous</h1>
    </div>
</section>

<main class="container  mt-2">
    <!-- <div> -->
    <h3 class="fs-2 fw-bold text-center p-2">Nous sommes fiers de vous présenter notre organisation</h3>
    <!-- </div> -->
    <div class=" d-block justify-content-center">
        <p class="paragApropos lh-lg">La page « À propos de nous » de Vidyard commence par un titre soulignant sa
            mission et passe directement
            aux fonctions principales de son produit. La page comporte une vidéo de démonstration du produit sur
            laquelle vous tomberez en vous promenant, révélant des cas d’utilisation supplémentaires. Enfin,
            l’équipe de direction est présentée.

            Cette approche de haut niveau d’une page À propos de nous met principalement l’accent sur les avantages
            des produits, avec un accent secondaire sur l’équipe. Si votre produit est complexe, c’est peut-être une
            approche à envisager. Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quia accusamus
            cupiditate!
            Voluptatibus excepturi ratione iure, vero est corporis praesentium voluptatem blanditiis, a molestiae
            hic soluta itaque suscipit voluptate id. La page « À propos de nous » de Vidyard commence par un titre
            soulignant sa mission et passe directement
            aux fonctions principales de son produit. La page comporte une vidéo de démonstration du produit sur
            laquelle vous tomberez en vous promenant, révélant des cas d’utilisation supplémentaires. Enfin,
            l’équipe de direction est présentée.

            Cette approche de haut niveau d’une page À propos de nous met principalement l’accent sur les avantages
            des produits, avec un accent secondaire sur l’équipe. Si votre produit est complexe, c’est peut-être une
            approche à envisager. Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quia accusamus
            cupiditate!
            Voluptatibus excepturi ratione iure, vero est corporis praesentium voluptatem blanditiis, a molestiae
            hic soluta itaque suscipit voluptate id.</p>

    </div>
    <div class="aproposImg2 mb-5">
        <img src="./assets/img/apropos-nous.jpeg" alt="apropos-nous">
    </div>
</main>


    <!-- Promotion du livre -->
    <section class=" container-fluid promotions mt-5 p-5 bg-promo">
        <div class="row">
            <div class="col-5 p-5">
                <h2 class="text-white">Top sellers</h2>
                <p class="p-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates consequatur earum
                    totam doloremque numquam aliquid ex voluptate alias recusandae sint ad, a esse omnis distinctio, repellat
                    fugiat blanditiis repellendus quam.</p>
            </div>

            <div class="col-3 promo1  border border-white rounded-4 py-2 ">
                <div class="small-img1">
                    <img src="./assets/img/promo_1.jpg" alt="img-promo">
                    <button type="submit" class="btn btn-outline-secondary rounded-5">20€</button>
                    <span class="p-2">lorem lorem</span>
                    <span>lorem lorem lorem</span>
                </div>
            </div>

            <div class="col-3 promo2  border border-white rounded-4 py-2 ">
                <div class="small-img2 ">
                    <img src="./assets/img/promo_2.jpg" alt="img-promo">
                    <button type="submit" class="btn btn-outline-secondary rounded-5">20€</button>
                    <span class="p-2">lorem lorem</span>
                    <span>lorem lorem lorem</span>
                </div>
            </div>
        </div>

    </section>

<?php
require_once "inc/footer.inc.php";
?>