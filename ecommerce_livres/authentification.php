<?php

require_once "inc/functions.inc.php";


$info = '';

if (!empty($_POST)) {
  // debug($_POST);

  $verif = true;

  foreach($_POST as $value) {


    if (empty($value)) {

      $verif = false;
    }

  }

  if (!$verif) {
    debug($_POST);


    $info = alert("Veuillez renseigner tout les champs", "danger");

  } else {
    
    debug($_POST);

    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : null;

    $user = checkUser($email, $nom);
        if ($user) {

            if (password_verify($mdp, $user['mdp'])){
                $_SESSION['user'] = $user;

                header("location:" .RACINE_SITE. "profil.php");
            }else {
            $info = alert("Les identifiants sont incorrectes", "danger");
        }
    }

    }
}

if (!empty($_POST)) {
    // debug($_POST);
  
    $verif = true;
  
    foreach($_POST as $value) {
  
      if (empty($value)) {
  
        $verif = false;
      }
  
    }
  
    if (!$verif) {
      debug($_POST);
  
      $info = alert("Veuillez renseigner tout les champs", "danger");
  
    } else {
      
      debug($_POST);
  
      $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
      $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
      $email = isset($_POST['email']) ? $_POST['email'] : null;
      $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : ''; // Set to empty string if not present
  
      $user = checkUser($email, $nom);
          if ($user) {
              
              if (!empty($mdp) && password_verify($mdp, $user['mdp'])){ // Add check for empty $mdp
                  $_SESSION['user'] = $user;
  
                  header("location:" .RACINE_SITE. "profil.php");
              }else {
              $info = alert("Les identifiants sont incorrectes", "danger");
          }
      }
  
      }
  }




$title = "authentification";
require_once "inc/header.inc.php";
?>


<main>
<form action="" method="post" class="w-50 mx-auto p-3 text-white rounded-5 formV border p-5 col-sm-12 col-md-8">
            <h1 class="titre-2 display-3 fs-1">Page de Connexion</h1>
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

            <div class="p-3 inputs col-sm-12">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control rounded-pill input-custom" id="mdp" name="mdp">
                <i class="bi bi-eye-slash ms-3 iconeye" id="togglePassword"></i>
            </div>
            <!-- <div class="p-3 inputs col-sm-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control rounded-pill input-custom" id="password" name="password">
                <input type="checkbox" onclick="showPass()"> <span class="text-danger">Afficher/masquer le mot de passe</span>
                <span class="inputError"></span>
            </div> -->

            <button type="submit" class="btn btn-outline-dark rounded-start ms-4 bouton">Submit</button>
            
        </form>
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