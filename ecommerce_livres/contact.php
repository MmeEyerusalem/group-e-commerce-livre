<?php

// require_once "functions.inc.php";






$title = "contact";
require_once "inc/header.inc.php";
?>

<main class="bg-contact">
    <!-- Image d'en-tête contactez-nous -->
    <section class="affiche-contact">
        <!-- <div class="text-center fw-bold text-dark col-sm-12">
                 <h1 class="titre-2 display-3 ">Contactez-Nous!</h1>  -->
        <!-- </div> -->
    </section>

    <!-- Formulaire de contact -->
    <section class="ecrivez-nous p-2">
        <form action="#" method="#" class="w-50 mx-auto p-3 text-white rounded-5 formV border p-5 col-sm-12 col-md-8">
            <h1 class="titre-2 display-3 ">Contactez-Nous!</h1>
            <div class="p-3 inputs col-sm-12">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control rounded-pill input-custom" id="prenom" name="prenom">
                <span class="inputError"></span>
            </div>

            <div class="p-3 inputs col-sm-12">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control rounded-pill input-custom" id="nom" name="nom">
                <span class="inputError"></span>
            </div>

            <div class="p-3 inputs col-sm-12">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control rounded-pill input-custom" id="email" name="email">
                <span class="inputError"></span>
            </div>


            <div class="p-3 col-sm-12">
                <label for="exampleFormControlTextarea1" class="form-label">Comments</label>
                <textarea class="form-control rounded-pill input-custom" id="exampleFormControlTextarea1"
                    style="height: 90px"></textarea>
            </div>

            <button type="submit" class="btn btn-outline-dark rounded-start ms-4 bouton">Envoyer</button>
            <!-- </div> -->
        </form>

    </section>

    <!-- Promotion du livre -->
    <section class="promotions mt-5 p-5 bg-promo">
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
</main>

<?php
require_once "inc/footer.inc.php";
?>

<!-- Code vérifié par le validateur W3 -->