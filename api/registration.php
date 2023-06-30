<?php
// On require la config
require_once './config.php';
require_once '../tools/function.php';

// 1- On vérifie que l'on reçoit bien les données du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    // 2- On crée une fonction qui va sécuriser les données reçues


    // 3- On crée nos variables qui vont contenir les données sécurisées
    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);

    // 4- On DOIT encoder le password
    $pass_hash = password_hash($password, PASSWORD_BCRYPT);

    // Maintenant que nos données sont réceptionnées et sécurisées
    // On va effectuer plusieurs traitements
    // 5- Gestion des erreurs
    // On vérifie que l'email est rempli
    if (empty($email)) {
        // On revoie en GET à index.php le paramètre ?error=Veuillez saisir l'email"
        header("Location: ../index.php?error=Veuillez saisir l'email");
        exit();
    } else if (empty($password)) {
        // On revoie en GET à index.php le paramètre ?error=Veuillez saisir le mot de passe"
        header("Location: ../index.php?error=Veuillez saisir le mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // On revoie en GET à index.php le paramètre ?error=Veuillez saisir un email valide"
        header("Location: ../index.php?error=Veuillez saisir un mail valide");
        exit();
    } else {
        // On vérifie que l'email n'existe pas déjà dans la BDD
        // On récupere la variable de connexion à la BDD
        global $mysqli;

        // On créer la requete sql

        $query_get = "SELECT * FROM user WHERE email = '$email'";
        if ($result = mysqli_query($mysqli, $query_get)) {
            if (mysqli_num_rows($result) > 0) {

                // On ferme la connexion
                mysqli_close($mysqli);

                // Si on a un résultat on renvoie un message d'erreur
                header("Location: ../index.php?error=Cet Email existe déjà");
                exit();
            } else {
                // Si on a pas de résultat on peux inserer dans la BDD
                // On crée la requete sql
                $query_post = "INSERT INTO user (email, password)
                VALUES ('$email', '$pass_hash')";
                if (mysqli_query($mysqli, $query_post)) {
                    // Si l'insertion est bien faite on recupere l'utilisateur pour créer la session

                    if ($new_result = mysqli_query($mysqli, $query_get)) {
                        while ($new_user = mysqli_fetch_assoc($new_result)) {
                            if ($new_user['email'] === $email && $new_user['password'] === $pass_hash) {
                                // On peux créer la session
                                session_start();

                                // On va stocker l'email et l'id de l'utilisateur dans la session
                                $_SESSION['email'] = $new_user['email'];
                                $_SESSION['id'] = $new_user['id'];

                                // On ferme la connexion
                                mysqli_close($mysqli);

                                // On redirige sur la page home.php
                                header("Location: ../home.php");
                                exit();
                            }
                        }
                    }
                }
            }
        } else {
            // On ferme la connexion
            mysqli_close($mysqli);

            // On redirige
            header("Location: ../index.php?error=Erreur de connextion à la BDD");
            exit();
        }
    }
}
