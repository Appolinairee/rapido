<?php
session_start();

require_once('db/Chauffeur.php');

$chauffeurModel = new Chauffeur();
$chauffeurs = $chauffeurModel->read();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $chauffeur_id = $_GET['id'];
    $chauffeurDetails = (new Chauffeur())->readById($chauffeur_id);

    if (!$chauffeurDetails) {
        header("Location: erreur.php");
        exit();
    }
}

if (isset($_GET['dcid']) && !empty($_GET['dcid']))
    $delete_id = $_GET['dcid'];


if (isset($_SESSION['error_message'])) {
    $notificationClass = "error";
    $notificationMessage = $_SESSION['error_message'];
}

if (isset($_SESSION['success_message'])) {
    $notificationClass = "success";
    $notificationMessage = $_SESSION['success_message'];
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/table.css">
    <link rel="stylesheet" href="./styles/modal.css">
    <script src="https://kit.fontawesome.com/7028555391.js" crossorigin="anonymous"></script>
    <title>Chauffeurs - Rapido</title>
</head>

<body>
    <div class="content">

        <?php require_once('./menu.php'); ?>


        <div class="button flex addButton">
            <p>Ajouter un chauffeur</p>
            <i class="fa-solid fa-circle-plus"></i>
        </div>

        <main class="mt-8">
            <table class="w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                        <th>Téléphone</th>
                        <th>Sexe</th>
                        <th>Disponible</th>
                        <th>Editer</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($chauffeurs as $chauffeur) : ?>
                        <tr>
                            <td><?php echo $chauffeur['chauffeur_id']; ?></td>
                            <td><?php echo $chauffeur['nom']; ?></td>
                            <td><?php echo $chauffeur['prenoms']; ?></td>
                            <td><?php echo $chauffeur['telephone']; ?></td>
                            <td><?php echo $chauffeur['sexe']; ?></td>
                            <td><?php echo ($chauffeur['disponible'] == 1) ? 'Oui' : 'Non'; ?></td>
                            <td>
                                <a href="./chauffeurs.php?id=<?= $chauffeur['chauffeur_id'] ?>">
                                    <i class="fa-solid fa-pen-to-square tableIcon"></i>
                                </a>
                            </td>
                            <td>
                                <a href="./chauffeurs.php?dcid=<?= $chauffeur['chauffeur_id'] ?>">
                                    <i class="fa-solid fa-trash-can tableIcon deleteButton"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <div class="modal">
                <div class="overflow"></div>
                <div class="addCourse modalContent">
                    <form action="controllers/createchauffeur.php" method="POST">
                        <div class="flex">
                            <h3>Enregistrer un chauffeur</h3>
                            <div class="undisplayModal">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                        </div>

                        <div class="flex inputFlex">
                            <div class="input">
                                <label for="nom">Nom :</label> <br>
                                <input type="text" id="nom" name="nom" placeholder="Nom" required><br><br>
                            </div>

                            <div class="input">
                                <label for="prenoms">Prénoms :</label> <br>
                                <input type="text" id="prenoms" name="prenoms" placeholder="Prénoms" required><br><br>
                            </div>
                        </div>

                        <div class="flex inputFlex">
                            <div class="input">
                                <label for="telephone">Téléphone :</label> <br>
                                <input type="text" id="telephone" name="telephone" placeholder="Téléphone" required><br><br>
                            </div>

                            <div class="input">
                                <label for="sexe">Sexe :</label> <br>
                                <select id="sexe" name="sexe" required>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                </select>
                            </div>
                        </div>

                        <div class="input">
                            <label for="disponible">Disponible :</label> <br>
                            <select id="disponible" name="disponible" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select><br><br>
                        </div>

                        <input class="submitButton button" type="submit" value="Ajouter">
                    </form>
                </div>
            </div>



            <?php
            if (isset($chauffeurDetails))
                require_once("./modifierChauffeur.php");

            if (isset($delete_id)) {
            ?>

                <div class="update">
                    <div class="modal">
                        <div class="overflow"></div>
                        <div class="addCourse deleteModal">

                            <div class="flex">
                                <h3>Suppression du chauffeur.</h3>
                                <div class="undisplayModal">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </div>
                            </div>

                            <p>Voulez-vous vraiment supprimer le chauffeur ?</p>

                            <form action="./controllers/deletechauffeur.php" method="post">
                                <input type="number" name="chauffeur_id" value="<?= $delete_id ?>" hidden />
                                <input class="submitButton button" type="submit" value="Supprimer">
                            </form>
                        </div>
                    </div>
                </div>

            <?php }
            ?>
        </main>

        <div>
            <?php
            if (isset($notificationClass) && isset($notificationMessage)) {
            ?>
                <div class="notification <?php echo $notificationClass; ?>">
                    <?php echo $notificationMessage; ?>
                </div>
            <?php
            }
            ?>
        </div>

    </div>

    <?php
    unset($_SESSION['success_message']);
    unset($_SESSION['error_message']);
    ?>

    <script src="./js/script.js"></script>

</body>

</html>