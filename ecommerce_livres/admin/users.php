<?php

require_once"../inc/functions.inc.php";


if(!isset($_SESSION['user'])) {

    header("location:".RACINE_SITE."authentification.php");
}else{
    if($_SESSION['user']['role'] == 'ROLE_USER'){

        header("location:".RACINE_SITE."index.php");
    }
}

$title = "users";
require_once "../inc/header.inc.php";

?>

<main class="container">

    <div class="d-flex flex-column m-auto mt-5 table-responsive">
        <h2 class="text-center fw-bolder mb-5 text-danger">Listes des utilisateurs</h2>
        <table class="table table-dark table-bordered mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Civilite</th>
                    <th>Address</th>
                    <th>Code_postal</th>
                    <th>Ville</th>
                    <th>Pays</th>
                    <th>Role</th>
                    <td>Supprimer</td>
                    <td>Modifier le rôle</td>
                </tr>
            </thead>

            <tbody>

                <?php
                $users = allUsers();

                foreach ($users as $user) {

                    ?>
                    <tr>
                        <td>
                            <?= $user['id_user'] ?>
                        </td>
                        <td>
                            <?= ucfirst($user['prenom']) ?>
                        </td>
                        <td>
                            <?= ucfirst($user['nom']) ?>
                        </td>
                        <td>
                            <?= $user['telephone'] ?>
                        </td>
                        <td>
                            <?= $user['email'] ?>
                        </td>

                        <td>
                            <?= $user['civilite'] ?>
                        </td>
                        <td>
                            <?= $user['address'] ?>
                        </td>
                        <td>
                            <?= $user['code_postal'] ?>
                        </td>
                        <td>
                            <?= ucfirst($user['ville']) ?>
                        </td>
                        <td>
                            <?= ucfirst($user['pays']) ?>
                        </td>
                        <td>
                            <?= $user['role'] ?>
                        </td>
                        <td class="text-center">
                            <a href="dashboard.php?users_php&action=delete&id_user=< //$user['id_user'] ?> "></a>
                            <i class="bi bi-trash3-fill"></i>
                        </td>
                        <td class="text-center">
                            <a href="dashboard.php?users_php&action=update&id_user < //$user['id_user'] ?>" class="btn btn-danger"><?= ($user['role']) == 'ROLE_ADMIN' ? 'Rôle user' : 'Rôle admin' ?> </a>
                        </td>
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