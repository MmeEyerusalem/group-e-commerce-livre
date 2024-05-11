<?php

require_once "inc/functions.inc.php";

if (!empty($_SESSION['user'])) {
  header("location:" . RACINE_SITE . "profil.php");
}

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
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : null;
    $cmdp = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : null;
    $civilite = isset($_POST['civilite']) ? $_POST['civilite'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;
    $code_postal = isset($_POST['code_postal']) ? $_POST['code_postal'] : null;
    $ville = isset($_POST['ville']) ? $_POST['ville'] : null;
    $pays = isset($_POST['pays']) ? $_POST['pays'] : null;
    // echo "dfkhqsidjfioqsdfqhs";
    // $info = 'Vous être bien inscrit!';

    if (strlen($prenom) < 2 || preg_match('/[0-9]+/', $prenom)) {
      $info = 'le prenom n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (strlen($nom) < 2 || preg_match('/[0-9]+/', $nom)) {
      $info = 'le nom n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (!preg_match('#^[0-9]+$#', $telephone)) {
      $info = 'le phone n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $info = 'le email n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (strlen($mdp) < 5 || strlen($mdp) > 15) {
      $info = 'le mot de passe n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if ($mdp !== $cmdp) {
      $info = 'le mot de passe et la confirmation  ne sont pas le même.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if ($civilite != 'femme' && $civilite != 'homme') {
      $info = 'le civilité n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (strlen($address) < 3 || strlen($address) > 50) {
      $info = 'l\'address n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (!preg_match('#^[0-9]+$#', $code_postal)) {
      $info = 'le code postal n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (strlen($ville) > 20) {
      $info = 'la ville n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (strlen($pays) < 5 || strlen($pays) > 50) {
      $info = 'le pays n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (empty($info)) {

      $emailExist = checkEmailUser($email);
      $checkTelephoneUser = checkTelephoneUser($telephone);


      if ($emailExist || $checkTelephoneUser) {
        $info = 'Vous avez déjà un compte!';

        // header("location:" . RACINE_SITE . "register.php");

      } else if ($mdp !== $cmdp) {

        $info = 'Mot de passe invalide.';
        // header("location:" . RACINE_SITE . "register.php");

      } else {

        $mdp = password_hash($mdp, PASSWORD_DEFAULT);

        inscriptionUsers($prenom, $nom, $telephone, $email, $mdp, $civilite, $address, $code_postal, $ville, $pays);
        $info = 'Vous être bien inscrire.';

        // header("location:" . RACINE_SITE . "profil.php");

      }

    } else {

      debug($_POST);
      echo 'Non SUBMIT';
    }

  }
}




$title = "register";
require_once "inc/header.inc.php";
?>

<main class="bg-register">
  <!-- Image d'en-tête contactez-nous -->
  <section class="affiche-inscription">
    <div class="text-center text-white col-sm-12">
      <h1 class="titre-3 display-3">Registre!</h1>
      <i class="bi bi-chevron-down down"></i>
    </div>
  </section>

  <!-- Formulaire de contact -->

  <section class="ecrivez-nous p-5">
    <form action="" method="post" class="w-50 mx-auto p-3 text-white rounded-5 formV border p-5 col-sm-12 col-md-8">
    <?php
      echo $info;
    ?>  
    <div class="p-3 inputs col-sm-12">
        <label for="prenom" class="form-label">Prenom</label>
        <input type="text" class="form-control rounded-pill input-custom" id="prenom" name="prenom">
        <!-- <div id="prenomError" class="error"></div>
      <span class="inputError"></span> -->
      </div>

      <div class="p-3 inputs col-sm-12">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control rounded-pill input-custom" id="nom" name="nom">
        <!-- <div id="nomError" class="error"></div>
      <span class="inputError"></span> -->
      </div>


      <div class="p-3 inputs col-sm-12">
        <label for="tel" class="form-label">Téléphone</label>
        <input type="number" class="form-control rounded-pill input-custom" id="telephone" name="telephone"
          maxlength="10">
        <!-- <div id="telephoneError" class="error"></div>
  <span class="inputError"></span>  -->
      </div>

      <div class="p-3 inputs col-sm-12">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control rounded-pill input-custom" id="email" name="email">
        <!-- <div id="emailError" class="error"></div>
      <span class="inputError"></span> -->
      </div>

      <div class="p-3 inputs col-sm-12">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control rounded-pill input-custom" id="mdp" name="mdp">
        <i class="bi bi-eye-slash ms-3 iconeye" id="togglePassword"></i>
        <!-- <div id="passwordError" class="error"></div> -->
        <!-- <span class="inputError"></span> -->

      </div>

      <div class="p-3 inputs col-sm-12">
        <label for="confirmPassword" class="form-label">Confirmer mot de passe</label>
        <input type="password" class="form-control rounded-pill input-custom" id="confirmPassword"
          name="confirmPassword">
        <i class="bi bi-eye-slash ms-3 iconeye1" id="toggleConfirmPassword"></i>
        <!-- <div id="confirmPwdError" class="error"></div> -->
        <!-- <span class="inputError"></span> -->
      </div>

      <div class="p-3 civilite col-sm-12">
        <label for="choice" class="form-label">Civilite</label>
        <select name="civilite" id="choice" class="form-select rounded-pill input-custom">
          <option value="" selected>--- Choisir une option ---</option>
          <option value="femme">Femme</option>
          <option value="homme">Homme</option>
          <option value="autre">Autre</option>
        </select>
        <!-- <div id="choiceError" class="error"></div>  -->
      </div>

      <div class="p-3 inputs col-sm-12">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control rounded-pill input-custom" id="address" name="address">
        <!-- <div id="cpostalerror" class="error"></div>  
  <span class="inputError"></span>  -->
      </div>
      <div class="p-3 inputs col-sm-12">
        <label for="cpostal" class="form-label">Code postal</label>
        <input type="number" class="form-control rounded-pill input-custom" id="code_postal" name="code_postal">
        <!-- <div id="cpostalerror" class="error"></div>  
  <span class="inputError"></span>  -->
      </div>

      <div class="p-3 inputs col-sm-12">
        <label for="ville" class="form-label">Ville</label>
        <input type="text" class="form-control rounded-pill input-custom" id="ville" name="ville">
        <!-- <div id="villerror" class="error"></div>  
  <span class="inputError"></span>  -->
      </div>

      <div class="p-3 inputs col-sm-12">
        <label for="pays" class="form-label">Pays</label>
        <input type="text" class="form-control rounded-pill input-custom" id="pays" name="pays">
        <!-- <div id="payserror" class="error"></div>  
  <span class="inputError"></span>  -->
      </div>

      <!-- bouton -->
      <button type="submit" class="btn btn-outline-dark rounded-start ms-4 bouton">Registre</button>
      <p class="text-center mt-5">Vous avez déjà un compte ! <a href="authentification.php"
          class="text-danger text-white fw-bold">Connectez-vous ici</a></p>
      <!-- </div> -->
    </form>
  </section>


  <!-- Promotion du livre -->
  <section class="promotions mt-5 p-5 bg-promo">
    <div class="row">
      <div class="col-5 p-5">
        <h2 class="text-white">Top sellers</h2>
        <p class="p-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates consequatur earum totam
          doloremque numquam aliquid ex voluptate alias recusandae sint ad, a esse omnis distinctio, repellat
          fugiat blanditiis repellendus quam.</p>
      </div>

      <div class="col-3 promo1  border border-whit rounded-4 py-2   ">
        <div class="small-img1">
          <img src="./assets/img/promo_1.jpg" alt="img-promo">
          <button type="submit" class="btn btn-outline-secondary rounded-5">20€</button>
          <span class="p-2">lorem lorem</span>
          <span>lorem lorem lorem</span>
        </div>
      </div>

      <div class="col-3 promo2  border border-whit rounded-4 py-2 
          ">
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