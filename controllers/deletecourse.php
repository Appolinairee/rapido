<?php
session_start();

require_once('../db/Course.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST["course_id"];

    $courseManager = new Course();

    $success = $courseManager->delete($course_id);
    var_dump($success);

    if ($success) {
        $_SESSION['success_message'] = "Course supprimer avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la suppression.";
    }

    header("Location: ../index.php");
    exit();
}