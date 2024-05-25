<?php

require_once "../inc/functions.inc.php";

if(!isset($_SESSION['user'])) {

    header("location:".RACINE_SITE."authentification.php");
}else{
    if($_SESSION['user']['role'] == 'ROLE_USER'){

        header("location:".RACINE_SITE."index.php");
    }
}

if (isset($_GET['action']) && isset($_GET['id_livre'])) {
    if (!empty($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id_livre'])) {

        $idCategory = $_GET['id_livre'];
        $category = deleteLivre($idCategory);
    }
}


$livre = allLivres();
debug($films);


$title = "Livres";

require_once "../inc/header.inc.php";

?>

<main>
    <h2> Lists des Livres</h2>

    
    <div class="d-flex flex-column m-auto mt-5">

        <h2 class="text-center fw-bolder mb-5 text-danger">Liste des livres</h2>
        <a href="gestionLivres.php" class="btn btn-primary p-3 fs-3 align-self-end "> Ajouter un livre</a>
        <table class="table table-dark table-bordered mt-5 ">
            <thead>
                <tr>
                    <!-- th*7 -->
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Image</th>
                    <th>Ecrivain</th>
                    <th>Resume</th>
                    <th>Àge limite</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Date de sortie</th>
                    <th>Supprimer</th>
                    <th> Modifier</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   foreach($livress as $livre ){
                    // echo $livres['$title'];
                   
                ?>

                <tr>

                    <!-- Je récupére les valeus de mon tabelau $film dans des td -->
                    <td><?=$livre['id_livre']?></td>
                    <td><?=$livre['title'] ?></td>
                    <td> <img src="<?= RACINE_SITE ."assets/".$livre['image']?>" alt="affiche du livre" class="img-fluid"></td>
                    <td><?=$livre['ecrivain']?> </td>
                    <td><?=$livre['ageLimit']?></td>
                    <td><?=$livre['price'] ?></td>
                    <td><?=$livre['stock'] ?></td>
                    <td><?=substr($livre['resume'], 0, 50 )?>...</td>
                    <td><?=$livre['date'] ?></td>
                    
                   
                    <td class="text-center"><a href="films.php?action=delete&id_film=<?=$livre['id_livre']?>"><i class="bi bi-trash3-fill"></i></a></td>
                    <td class="text-center"><a href="gestionFilms.php?action=update&id_film=<?=$livre['id_livre']?>"><i class="bi bi-pen-fill"></i></a></td>

                </tr>

        <?php
            }
        ?>
            </tbody>


        </table>


    </div>




</main>






<?php
    require_once "../inc/footer.inc.php";
?>