<?php
// On récupere la config
require_once './config.php';
require_once '../tools/function.php';

// On démarre la session
session_start();

// On vérifie si le titre et la description ne sont pas vide
if (isset($_POST['titre']) && isset($_POST['description']) && isset($_SESSION['id'])) {

    // On définit nos variables
    global $mysqli;
    $titre = validate($_POST['titre']); // On récupere le titre
    $description = validate($_POST['description']); // On récupere la description
    $id = $_SESSION['id']; // On récupere l'id de l'utilisateur connecté
    $created_at = time(); // On récupere le timestamp actuel

    // On créer la requete sql pour ajouter un post
    $query = "INSERT INTO `post` (`titre`, `description`, `created_at`, `user_id`)
    VALUES (?, ?, ?, ?)";

    // Gestion des cas d'erreur
    if (empty($titre)) {
        header("Location: ../create_post.php?error=Le titre est obligatoire");
        exit();
    } else {
        // On prépare la requete
        if ($stmt = mysqli_prepare($mysqli, $query)) {
            mysqli_stmt_bind_param(
                $stmt,
                ('ssii'),
                $titre,
                $description,
                $created_at,
                $id
            );

            // On execute la requete
            if (!mysqli_stmt_execute($stmt)) {
                header("Location: ../create_post.php?error=Le post n'a pas pu s'enregistrer");
                exit();
            }

            // On ferme la connexion
            mysqli_close($mysqli);

            // On redirige sur la page d'accueil
            header("Location: ../home.php");
        }
    }
} else {
    header("Location: ../create_post.php?error=Une erreur est survenue lors de la reception des données");
    exit();
}
