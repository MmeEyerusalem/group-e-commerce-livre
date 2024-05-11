<?php


session_start();

define("RACINE_SITE", "/group-ecommerce-livres/ecommerce_livres/");

///////////////Fonction de connexion à la BDD////////////////////

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "bookstore");

function connexionBdd() {

        $pdo = new PDO('mysql:host=localhost;dbname=bookstore;charset=utf8', 'root', '');

        $dsn = "mysql:host=" .DBHOST.";dbname=".DBNAME.";charset=utf8";

        try {
            
            $pdo = new PDO($dsn, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        }
        catch(PDOException $e) {

        die($e->getMessage());

        }

        return $pdo;

        
}
// connexionBdd();


//////////////////////////////////creation table users///////////////
function createTableUsers() {

    $pdo = connexionBdd();

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id_user INT PRIMARY KEY AUTO_INCREMENT,
        prenom VARCHAR(50) NOT NULL,
        nom VARCHAR(50) NOT NULL,
        telephone VARCHAR(30) NOT NULL,
        email VARCHAR(100) NOT NULL,
        mdp VARCHAR(255) NOT NULL,
        civilite ENUM('f', 'h') NOT NULL,
        address VARCHAR(50) NOT NULL,
        code_postal VARCHAR(50) NOT NULL,
        ville VARCHAR(50) NOT NULL,
        pays VARCHAR(50) NOT NULL
    )";

    $request = $pdo->exec($sql);

}

// createTableUsers();

//////////////////////////////////creation table livres///////////////

function createTableLivres() {

    $pdo = connexionBdd();

    $sql = "CREATE TABLE IF NOT EXISTS livre (
            id_livre INT PRIMARY KEY AUTO_INCREMENT,
            id_categorie INT NOT NULL,
            titre VARCHAR (30) NOT NULL,
            autor VARCHAR (30) NOT NULL ,
            prix FLOAT NOT NULL,
            stock INT NOT NULL
        )";

    $request = $pdo->exec($sql);
}

// createTableLivres();

//////////////////////////////////creation table categories///////////////

function createTableCategories() {

    $pdo = connexionBdd();

    $sql = "CREATE TABLE IF NOT EXISTS categorie (
            id_categorie INT PRIMARY KEY AUTO_INCREMENT,
            nom VARCHAR (30) NOT NULL,
            description VARCHAR (30) NOT NULL
        )";

    $request = $pdo->exec($sql);
}

// createTableCategories();

//////////////////////////////////creation table panier///////////////

function createTablePanier() {

    $pdo = connexionBdd();

    $sql = "CREATE TABLE IF NOT EXISTS panier (
            id_panier INT PRIMARY KEY AUTO_INCREMENT,
            id_user INT NOT NULL,
            id_livre INT NOT NULL,
            quantite INT NOT NULL
        )";

    $request = $pdo->exec($sql);
}

// createTablePanier();

///////////////////////function of debug///////////////////:::

function debug($var){
    echo '<pre>';
    var_dump($var);
    echo'</pre>';
}

  //////////////////// Fonctions du CRUD pour les utilisateurs Users /////////////////////

  function inscriptionUsers(string $prenom, string $nom, string $telephone, string $email, string $mdp, string $civilite, string $address, string $code_postal, string $ville, string $pays) 
  : void {

      $pdo = connexionBdd(); // je stock ma connexion  à la BDD dans une variable

      $sql = "INSERT INTO users 
      (prenom, nom, telephone, email, mdp, civilite, address, code_postal, ville, pays)
      VALUES
      (:prenom, :nom, :telephone, :email, :mdp, :civilite, :address, :code_postal, :ville, :pays)"; // Requête d'insertion que je stock dans une variable
      $request = $pdo->prepare($sql); // Je prépare ma requête et je l'exécute
      $request->execute( 
          array(
          ':prenom' => $prenom,
          ':nom' => $nom,
          ':telephone' => $telephone,
          ':email' => $email,
          ':mdp' => $mdp,
          ':civilite' => $civilite,
          ':address' => $address,
          ':code_postal' => $code_postal,
          ':ville' => $ville,
          ':pays' => $pays

      ));

  }

      ////////////////// Fonction pour vérifier si un email existe dans la BDD ///////////////////////////////

      function checkEmailUser(string $email) :mixed {
        $pdo = connexionBdd();
        $sql = "SELECT * FROM users WHERE email = :email";
        $request = $pdo->prepare($sql);
        $request->execute( array(
            ':email' => $email

        ));

        $resultat = $request->fetch();
        return $resultat;
    }

        ////////////////// Fonction pour vérifier si un telephone existe dans la BDD ///////////////////////////////

        function checkTelephoneUser(string $telephone) {
            $pdo = connexionBdd();
            $sql = "SELECT * FROM users WHERE telephone = :telephone";
            $request = $pdo->prepare($sql);
            $request->execute( array(
                ':telephone' => $telephone
    
            ));
    
            $resultat = $request->fetch();
            return $resultat;
        }

////////////////////// Fonction d'alert ////////////////////////////////////////

function alert(string $contenu, string $class) {

    return "<div class='alert alert-$class alert-dismissible fade show text-center w-50 m-auto mb-5' role='alert'>
        $contenu

            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>

        </div>";


}

///////////////// Fonction pour vérifier un utilisateur/////////////////////

function checkUser(string $email, string $nom) :mixed {

    $pdo =connexionBdd();
    $sql = "SELECT * FROM users WHERE nom = :nom AND email = :email";
    $request = $pdo->prepare($sql);
    $request->execute(array(

        ':nom'=> $nom,
        ':email' => $email
    ));

    $resultat = $request->fetch();
    return $resultat;
}

/////////////Fonction de déconnexion ////////////////

function logOut(){

    if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == 'deconnexion' ){


        unset($_SESSION['user']); // On supprime l'indice "user " de la session pour se déconnecter // cette fonction détruit les variables  stocké  comme 'firstName' et 'email'.

        //session_destroy(); // Détruit toutes les données de la session déjà  établie . cette fonction détruit la session sur le serveur 

        header("location:".RACINE_SITE."index.php");
    }

}
// logout();

///////////////////////Fonction AddLivres//////////////////////////////////////////

function addLivre($category, string $title, string $ecrivain, string $resume, string $ageLimit, string $image, string $dateSortie, float $price, int $stock )
{

    $pdo = connexionBdd();
    $sql = "INSERT INTO livre(id_category, title, ecrivian, resume, date, ageLimit, image, price, stock )VALUES (:id_caregory, :title, :ecrivian, :resume, :date, :ageLimit, :image, :price, :stock )";
    $request= $pdo->prepare($sql);
    $request->execute(array(

        ':id_category'=>$category,
        ':title'=>$title,
        ':ecrivian'=>$ecrivain,
        ':resume'=>$resume,
        ':dateSortie'=>$dateSortie,
        ':ageLimit'=>$ageLimit,
        ':image'=>$image,
        ':price'=>$price,
        ':stock'=>$stock
    ));
}
