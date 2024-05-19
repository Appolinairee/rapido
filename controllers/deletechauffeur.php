<?php
session_start();

require_once('../db/Chauffeur.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chauffeur_id = $_POST["chauffeur_id"];

    $courseManager = new Chauffeur();

    $success = $courseManager->delete($chauffeur_id);
    var_dump($success);

    if ($success) {
        $_SESSION['success_message'] = "Chauffeur supprimer avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la suppression.";
    }

    header("Location: ../chauffeurs.php");
    exit();
}