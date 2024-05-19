<?php
session_start();

require_once '../db/Chauffeur.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenoms = htmlspecialchars($_POST["prenoms"]);
    $telephone = htmlspecialchars($_POST["telephone"]);
    $sexe = htmlspecialchars($_POST["sexe"]);
    $disponible = intval($_POST["disponible"]);

    $chauffeurManager = new Chauffeur();

    $params = array(
        ':nom' => $nom,
        ':prenoms' => $prenoms,
        ':telephone' => $telephone,
        ':sexe' => $sexe,
        ':disponible' => $disponible
    );
    
    $success = $chauffeurManager->create($params);

    if ($success) {
        $_SESSION['success_message'] = "Nouveau chauffeur ajouté avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de l'ajout du chauffeur.";
    }

    header("Location: ../chauffeurs.php");
    exit();
}