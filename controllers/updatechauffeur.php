<?php
session_start();

require_once('../db/Chauffeur.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chauffeur_id = $_POST["chauffeur_id"];
    $nom = $_POST["nom"];
    $prenoms = $_POST["prenoms"];
    $telephone = $_POST["telephone"];
    $sexe = $_POST["sexe"];
    $disponible = intval($_POST["disponible"]);

    $chauffeurManager = new Chauffeur();

    $params = array(
        ':chauffeur_id' => $chauffeur_id,
        ':nom' => $nom,
        ':prenoms' => $prenoms,
        ':telephone' => $telephone,
        ':sexe' => $sexe,
        ':disponible' => $disponible
    );

    $success = $chauffeurManager->update($params);

    if ($success) {
        $_SESSION['success_message'] = "Chauffeur mis à jour avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la mise à jour du chauffeur.";
    }

    header("Location: ../chauffeurs.php");
    exit();
}
