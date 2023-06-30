<?php
require_once './config.php';
require_once '../tools/function.php';
if (isset($_POST['id']) && isset($_POST['titre']) && isset($_POST['description'])) {
    // on déclare nos variables
    $param = http_build_query($_POST);
    global $mysqli;
    $id = intval($_POST['id']);
    $titre = validate($_POST['titre']);
    $description = validate($_POST['description']);
    // on crée la requête
    $query = "UPDATE post
    SET titre=?, description=?
    WHERE id = $id";

    // on prépare la requête
    if ($stmt = mysqli_prepare($mysqli, $query)) {
        mysqli_stmt_bind_param(
            $stmt,
            'ss',
            $titre,
            $description
        );
        // on exécute la requête
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../update_post.php?$param&error= Une erreur est survenue");
            exit();
        }
        // on redirige vers la page home
        header("Location: ../home.php");
    }
}
