<?php
session_start();

require_once '../db/Course.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $point_depart = htmlspecialchars($_POST["point_depart"]);
    $point_arrivee = htmlspecialchars($_POST["point_arrivee"]);
    $date_heure = htmlspecialchars($_POST["date_heure"]);
    $chauffeur_id = htmlspecialchars($_POST["chauffeur_id"]);
    $statut = $statut = intval($_POST["statut"]);

    $courseManager = new Course();

    $params = array(
        ':point_depart' => $point_depart,
        ':point_arrivee' => $point_arrivee,
        ':date_heure' => $date_heure,
        ':chauffeur_id' => $chauffeur_id,
        ':statut' => $statut
    );

    $success = $courseManager->create($params);

    if ($success) {
        $_SESSION['success_message'] = "Nouvelle course ajoutée avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de l'ajout de la course.";
    }

    header("Location: ../index.php");
    exit(); 
}
