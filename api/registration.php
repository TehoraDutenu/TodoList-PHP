<?php

// on require la config
require_once './config.php';

var_dump($_POST);

// on vérifie que l'on reçoit bien les données du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    // on crée une fonction qui va sécuriser les données reçues
    function validate($data)
    {
        $data1 = trim($data); // supprime les espaces avant ou après la saisie
        $data2 = stripslashes($data1); // supprime les antislashs
        $data3 = htmlspecialchars($data2); // convertit les caractères spéciaux en string
        return $data3;
    }

    // on crée nos variables qui vont contenir les données sécurisées
    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);

    // on doit encoder le password (OBLIGATOIRE)
    $pass_hash = password_hash($password, PASSWORD_BCRYPT);

    // maintenant que nos données sont récupérées et sécurisées
    // on va effectuer plusieurs traitements
    // gestion des erreurs 
    // on vérifie que le champ email est rempli
    if (empty($email)) {
        // on renvoie en GET à index.php le paramètre "?error:veuillez saisir l'email"
        header("Location:../index.php?error=Veuillez saisir l'email");
        exit();
    } else if (empty($password)) {
        header("Location: ../index.php?error=Veuillez saisir le mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=Veuillez saisir un email valide");
        exit();
    } else {
        // vérifier que l'email n'est pas déjà dans la BDD
        // on récupère la variable de connexion
        global $mysqli;
        // on crée la requête sql
        $query_get = "SELECT * FROM user WHERE email = '$email'";

        if ($result = mysqli_query($mysqli, $query_get)) {
            // on regarde si on a une résultat qui sort
            if (mysqli_num_rows($result) > 0) {
                // si on a un résultat on renvoie un msg d'erreur
                header("Location: ../index.php?error=Cet email existe déjà");
            } else {
                // insérer dans la BDD et créer la requête sql
                $query_post = "INSERT INTO user (email, password)
                VALUES ('$email', '$pass_hash')";
                if (mysqli_query($mysqli, $query_post)) {
                    // si l'insertion est bien faite on récupère l'utilisateur
                    // pour créer la session
                    if ($new_result = mysqli_query($mysqli, $query_get)) {
                        while ($new_user = mysqli_fetch_assoc($new_result)) {
                            if ($new_user['email'] === $email && $new_user['password'] === $pass_hash) {
                                // on peut créer la session
                                session_start();
                                // on va stocker l'email et l'id de l'utilisateur dans la session
                                $_SESSION['email'] = $new_user['email'];
                                $_SESSION['id'] = $new_user['id'];
                                // rediriger sur la page home.php
                                header("Location: ../home.php");
                            }
                        }
                    }
                }
            }
        } else {
            header("Location: ../index.php?error=Erreur de connexion à la BDD");
            exit();
        }

        // TODO: pour tous les cas, on gère les erreurs
    }
}
