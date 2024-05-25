<?php

require_once "../inc/functions.inc.php";

if(!isset($_SESSION['user'])) {
    header("location:".RACINE_SITE."authentification.php");
}else{
    if($_SESSION['user']['role'] == 'ROLE_USER'){
        header("location:".RACINE_SITE."index.php");
    }
}

/////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id_livre'])) {

    if (!empty($_GET['action']) && $_GET['action'] == 'update' && !empty($_GET['id_livre'])) {

        $idLivre = $_GET['id_livre'];
        $livre = showLivre($idLivre);
    }

    
}

/////////////////////////////////

$info = '';

if (!empty($_POST)) {
    // debug($_POST);
    $verif = true;

    foreach ($_POST as $value) {

        if(empty(trim($value))) {
            $verif = false;
        }
    }
    // la superLobal $_FILES a un indice "image" qui correspond au "name" de l'input type="file" du formulaire, ainsi qu'un indice "name" qui contient le nom du fichier en cours de téléchargement.

    if (!empty($_FILES['image']['name'])) {  //si le nom du fichier en cours de téléchargement n'est pas vide, alors c'est qu'on est entrain de télécharger une photo
        // debug($_FILES);

        $image = $_FILES['image']['name']; //$image contient le chemi relatif de la photo et sera enregistré en BDD. On utilise ce chemin pour les "src" des balises <img>.

        // copy($_FILES['image']['tmp_name'], '../assets/'.$image);

        //On enregistre le ficher image qui se trouve à l'adresse contenue dan $_FILES['image']['tmp_name'] vers la destination qui est le dossier "img" à l'adresse

    }

  

    if (!$verif || empty($image)) {

        $info = alert("Tout les champs sont requis", "danger");
        
    }

    if (!isset($_POST['title']) || (strlen($_POST['title']) < 3 && trim($_POST['title'])) || preg_match('/[0-9]+/', $_POST['title'])) {


        $info = alert("Le champ titre n'est pas valide", "danger");
    }

    if (!isset($_POST['ecrivian']) || (strlen($_POST['ecrivian']) < 2 && trim($_POST['ecrivian'])) || preg_match('/[0-9]+/', $_POST['ecrivian'])) {

        $info = alert("Le champs Réalisateur n'est pas valide", "danger");
    }
 
    if (!isset($_POST['categories'])) {

        $info .= alert("Le champs catégories n'est pas valide", "danger");
    }

    if (!isset($_POST['synopsis']) || strlen($_POST['synopsis']) < 50) {

        $info .= alert("Le champs synopsis n'est pas valide", "danger");
    }

    if (!isset($_POST['duration'])) {

        $info .= alert("Le champs duration n'est pas valide", "danger");
    }

    if (!isset($_POST['date'])) {

        $info .= alert("Le champs date n'est pas valide", "danger");
    }

    if (!isset($_POST['price']) || !is_numeric($_POST['price'])) {

        $info .= alert("Le prix n'est pas valide", "danger");
    }

    if (!isset($_POST['stock'])) {

        $info .= alert("Le stock n'est pas valide", "danger");
    }



    //S'il n y a pas d'erreur sur le formulaire
    if (empty($info)) {

        $title = htmlentities(trim($_POST['title']));
        $ecrivian = htmlentities(trim($_POST['ecrivian']));
        $resume = htmlentities(trim($_POST['resume']));
        $dateSortie = $_POST['date'];
        $ageLimit = $_POST['ageLimit'];
        $image = $_FILES['image']['name'];
        $price = (float) htmlentities(trim($_POST['price']));
        $stock = (int) $_POST['stock'];
        $category = $_POST['categories'];


            if ($_GET['action'] == "update") {
                updateLivre($id_livre, $category, $title, $ecrivian, $resume, $ageLimit, $dateSortie, $price, $stock);
                // move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/' . $image);

                if ($_FILES['image']['size'] > 0) {
                    $pdo = connexionBdd();
                    // $sql = "INSERT INTO films(image) VALUE(:image) WHERE id_film = :id_film";
                    $sql = "UPDATE livre SET image = :image WHERE id_livre = :id_livre";
                    $request = $pdo->prepare($sql);
                    $request->execute(array(
                        ":id_livre" => $id_livre,
                        ":image" => $image
                    ));

                    move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/' . $image);
                }
            } else {
                addLivre($category, $title, $ecrivian, $resume, $ageLimit, $dateSortie, $price, $stock);
                move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/' . $image);
            }
            header('Location: livres.php');
        }
}





$title = "Gestion/Livres";
require_once "../inc/header.inc.php";
?>

<main class="container">
    <h2 class="text-center fw-bolder mb-5 text-danger"> <?= isset($livre)? 'Modifier un livre' : 'Ajouter un livre'?></h2>
    <?php
    // debug($_POST);
    echo $info;

    ?>
    <form action="" method="post" enctype="multipart/form-data" class="back">
        <!-- L'attribut enctype spécifie que le formulaire envoi des fichiers en plus des données 'text' => permet de UPLOADER un fichier (photo) => Il est obligatoire--->

        <div class="row">
            <div class="col-md-6 mb-5">
                <label for="title">Titre de livre</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= $livre['title'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5">
                <label for="image">Photo</label>
                <br>
                <!-- <input type="file" name="image" id="image "> -->
                <input class="form-control fs-3" type="file" id="image" name="image" value="<?= $livre['image'] ?? '' ?>">
           
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-5">
                <label for="ecrivian">Ecrivian</label>
                <input type="text" class="form-control" id="ecrivian" name="ecrivian" value="<?= $livre['ecrivian'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5">
                <label for="actors">Resume(s)</label>
                <input type="text" class="form-control" id="resume" name="resume" value="<?= $livre['resume'] ?? '' ?>">
            </div>
            <div class="col-md mb-5">
                <label for="date">Date de sortie</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= $livre['date']?? ''?>">
            </div>
        </div>

        <div class="row">
            <div class="mb-3">
                <label for="ageLimit" class="form-label">Age limite</label>
                <select multiple class="form-select form-select-lg fs-3" name="ageLimit" id="ageLimit">
                    <option value="10"<?php if(isset($livre['ageLimit']) && $livre['ageLimit'] ==10) echo 'selected' ?>>10</option>
                    <option value="13"<?php if(isset($livre['ageLimit']) && $livre['ageLimit'] ==13) echo 'selected' ?>>13</option>
                    <option value="16"<?php if(isset($livre['ageLimit']) && $livre['ageLimit'] ==16) echo 'selected' ?>>16</option>
                </select>
            </div>
        </div>

        <div class="row">
            <label for="categories">Genre du livre</label>
            </div>
            <?php

                $categories = allCategories();
                // debug($categories);

                foreach($categories as $category) {

            ?>
            <!-- <div class="row"> -->
            <div class="form-check col-sm-12 col-md-4">
                    <input type="radio" name="categories" class="form-check-input" id="flexRadioDefault1" value="<?= $category['id_category'] ?>" <?php if (isset($livre['category_id']) && $livre['category_id'] == $category['id_category']) echo 'checked' ?>>

                    <label class="form-check-label" for="flexRadioDefault1"><?= $category['name'] ?></label>
            </div>
            <!-- </div> -->
        

        <?php
             }
        ?>

        <div class="row">
            <div class="col-md mb-5">
                <label for="duration">Durée du livre</label>
                <input type="time" class="form-control" id="duration" name="duration" value="<?= $livre['duration']?? ''?>">
            </div>
            <div class="col-md mb-5">
                <label for="date">Date de sortie</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= $livre['date']?? ''?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-5">
                <label for="price">Prix</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="price" name="price" aria-label="Euros amount (with dot and two decimal places)" value="<?= $livre['price']?? ''?>">
                    <span class="input-group-text">€</span>
                </div>
            </div>

            <div class="col-md-6 mb-5">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" min="0" value="<?= $livre['stock'] ?? '' ?>">
            </div>
        </div>

        <div class="row mb-5">
            <div class="class col-12">
                <label for="resume">Resume</label>
                <textarea class="form-control" type="text" name="resume" id="resume"  rows="10"><?= $livre['resume']?? ''?></textarea>
            </div>
        </div>

        <div class="row justify-content-center">
            <button type="submit" class="btn btn-danger w-25 p-3 fw-bolder fs-3"><?= (isset($livre)) ? 'Modifier un livre' : 'Ajouter un livre' ?></button>
        </div>
    </form>





</main>











<?php
require_once "../inc/footer.inc.php";
?>