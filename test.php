$info = '';

// if (isset($_POST['registre'])) {
  

if ( !empty($_POST)) {
    // debug($_POST);

    $verif = true;

    foreach ($_POST as $value) {


        if (empty($value) ) {

            $verif = false;
        }

    }

    if (!$verif) {
        debug($_POST);


        $info = alert("Veuillez renseigner tout les champs", "danger");

    }
      else {

        debug($_POST);


        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $cmdp = $_POST['confirmPassword'];
        $civilite = $_POST['civilite'];
        $address = $_POST['cpostal'];
        // $code_postal = $_POST['code_postal'];
        $ville = $_POST['ville'];
        $pays = $_POST['pays'];
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

    if ($civilite != 'f' && $civilite != 'h') {
      $info = 'le civilité n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    if (strlen($address) < 5 || strlen($address) > 50) {
      $info = 'l\'address n\'est pas valide.';
      // header("location:" . RACINE_SITE . "register.php");
    }

    // if (!preg_match('#^[0-9]+$#', $code_postal)) {
    // $info = 'le code postal n\'est pas valide.';
    // header("location:" . RACINE_SITE . "register.php");
    // }

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
      $checkTelephoneUser = checkTelephoneUser($pseudo);


      if ($emailExist || $checkTelephoneUser) {
        $info = 'Vous avez déjà un compte.le code postal n\'est pas valide.';

        header("location:" . RACINE_SITE . "register.php");

      } else if ($mdp !== $cmdp) {

        $info = 'Mot de passe invalide.';
        header("location:" . RACINE_SITE . "register.php");

      } else {

        $mdp = password_hash($mdp, PASSWORD_DEFAULT);

        inscriptionUsers($prenom, $nom, $telephone, $email, $mdp, $civilite, $address, $code_postal, $ville, $pays);
        $info = 'Vous être bien inscrire.';

        header("location:" . RACINE_SITE . "profil.php");

      }


    }else {

    // debug($_POST);
    echo 'Non SUBMIT';
  }

}



$title = "enregistrement";
require_once "inc/header.inc.php";













?>

<p style="color: red;"><?php //if (isset($_GET['$info'])) {
  // echo $_GET['$info'];
  //} ?></p>