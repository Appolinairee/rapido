<?php

session_start();

require_once("db/Course.php");
require_once("db/Chauffeur.php");

$coursesWithChauffeurs = (new Course())->readWithChauffeurs();
$chauffeurs = (new Chauffeur())->read();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $course_id = $_GET['id'];
    $courseDetails = (new Course())->readById($course_id);

    if (!$courseDetails) {
        header("Location: erreur.php");
        exit();
    }

    $chauffeurs = (new Chauffeur())->read();
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
    <title>Rapido</title>
</head>

<body>
    <div class="content">

        <?php require_once('./menu.php'); ?>

        <div class="button flex addButton">
            <p>Ajouter une course</p>
            <i class="fa-solid fa-circle-plus"></i>
        </div>

        <main class="mt-8">
            <table class="w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Point de départ</th>
                        <th>Point d'arrivée</th>
                        <th>Date et heure</th>
                        <th>Chauffeur</th>
                        <th>Statut</th>
                        <th>Editer</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>

                <tbody class="">
                    <?php foreach ($coursesWithChauffeurs as $course) : ?>
                        <tr>
                            <td><?php echo $course['course_id']; ?></td>
                            <td><?php echo $course['point_depart']; ?></td>
                            <td><?php echo $course['point_arrivee']; ?></td>
                            <td><?php echo $course['date_heure']; ?></td>
                            <td><?php echo $course['chauffeur_nom'] . ' ' . $course['chauffeur_prenoms']; ?></td>
                            <td>
                                <?php
                                if ($course['statut'] == 0)
                                    echo "En attente";
                                else if ($course['statut'] == 1)
                                    echo "En cours";
                                else if ($course['statut'] == 2)
                                    echo "Terminée";
                                ?>
                            </td>
                            <td>
                                <a href="./index.php?id=<?= $course['course_id'] ?>">
                                    <i class="fa-solid fa-pen-to-square tableIcon"></i>
                                </a>
                            </td>

                            <td>
                                <a href="./index.php?dcid=<?= $course['course_id'] ?>">
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
                    <form action="controllers/createcourse.php" method="POST">
                        <div class="flex">
                            <h3>Enrégistrer une course.</h3>
                            <div class="undisplayModal">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                        </div>

                        <div class="flex inputFlex">
                            <div class="input">
                                <label for="point_depart">Point de départ</label> <br>
                                <input type="text" id="point_depart" name="point_depart" placeholder="Point de départ" required><br><br>
                            </div>

                            <div class="input">
                                <label for="point_arrivee">Point d'arrivée</label> <br>
                                <input type="text" id="point_arrivee" name="point_arrivee" placeholder="Point d'arrivée" required><br><br>
                            </div>
                        </div>

                        <div class="flex inputFlex">
                            <div class="input">
                                <label for="date_heure">Date et heure</label> <br>
                                <input type="datetime-local" id="date_heure" name="date_heure" required><br><br>
                            </div>

                            <div class="input">
                                <label for="statut">Statut</label> <br>
                                <select id="chauffeur_id" name="statut" required>
                                    <option value="0">En attente</option>
                                    <option value="1">En cours</option>
                                    <option value="2">Terminée</option>
                                </select>
                            </div>
                        </div>

                        <div class="input chauffeur">
                            <label for="chauffeur_id">Chauffeur</label> <br>
                            <select id="chauffeur_id" name="chauffeur_id" required>
                                <?php foreach ($chauffeurs as $chauffeur) : ?>
                                    <option value="<?php echo $chauffeur['chauffeur_id']; ?>"><?php echo $chauffeur['nom'] . ' ' . $chauffeur['prenoms']; ?></option>
                                <?php endforeach; ?>
                            </select><br><br>
                        </div>

                        <input class="submitButton button" type="submit" value="Ajouter">
                    </form>
                </div>
            </div>


            <?php
            if (isset($courseDetails))
                require_once("./modifierCourse.php");

            if (isset($delete_id)) {
            ?>

                <div class="update">
                    <div class="modal">
                        <div class="overflow"></div>
                        <div class="addCourse deleteModal">

                            <div class="flex">
                                <h3>Suppression de la course.</h3>
                                <div class="undisplayModal">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </div>
                            </div>

                            <p>Voulez-vous vraiment supprimer la course ?</p>

                            <form action="./controllers/deletecourse.php" method="post">
                                <input type="number" name="course_id" value="<?= $delete_id ?>" hidden />
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