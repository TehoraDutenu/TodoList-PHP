<?php

require_once './config.php';

if (isset($_GET['id'])) {
    // on déclare nos variables
    global $mysqli;
    $id = intval($_GET['id']);
    // on crée la requête
    $query = "DELETE FROM post WHERE id = $id";
    // on exécute la requête
    if ($result = mysqli_query($mysqli, $query)) {
        // on redirige vers la page home
        header("Location: ../home.php");
        exit();
    } else {
        header("Location: ../home.php?error=Une erreur est survenue lors de la suppression");
        exit();
    }
}
