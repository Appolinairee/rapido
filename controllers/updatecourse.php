<?php
session_start();

require_once('../db/Course.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST["course_id"];
    $point_depart = $_POST["point_depart"];
    $point_arrivee = $_POST["point_arrivee"];
    $date_heure = $_POST["date_heure"];
    $chauffeur_id = $_POST["chauffeur_id"];
    $statut = $statut = $statut = intval($_POST["statut"]);

    // Instanciation de la classe Course
    $courseManager = new Course();

    // Création des paramètres
    $params = array(
        ':course_id' => $course_id,
        ':point_depart' => $point_depart,
        ':point_arrivee' => $point_arrivee,
        ':date_heure' => $date_heure,
        ':chauffeur_id' => $chauffeur_id,
        ':statut' => $statut
    );

    $success = $courseManager->update($params);

    if ($success) {
        $_SESSION['success_message'] = "Course mise à jour avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la mise à jour de la course.";
    }

    header("Location: ../index.php");
    exit();
}
