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

    // maintenant que nos données sont récupérées et sécurisées
    // on va effectuer plusieurs traitements
    // gestion des erreurs 
    // on vérifie que le champ email est rempli
    if (empty($email)) {
        // on renvoie en GET à index.php le paramètre "?error:veuillez saisir l'email"
        header("Location:../login.php?error=Veuillez saisir l'email");
        exit();
    } else if (empty($password)) {
        header("Location: ../login.php?error=Veuillez saisir le mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login.php?error=Veuillez saisir un email valide");
        exit();
    } else {
        // on va vérifier que l'utilisateur existe bien dans la BDD
        global $mysqli;
        // on crée la requête sql
        $query = "SELECT * FROM user WHERE email = '$email'";
        // on exécute la requête
        if ($result = mysqli_query($mysqli, $query)) {
            // on regarde si on a un résultat
            if (mysqli_num_rows($result) < 1) {
                header("Location: ../login.php?erro=Email ou mot de passe incorrect");
                exit();
            }
            // si on a un résultat on vérifie le combo email / mot de passe
            while ($user = mysqli_fetch_assoc($result)) {
                if ($user['email'] == $email && password_verify($password, $user['password'])) {
                    // on crée la session
                    session_start();
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['id'] = $user['id'];
                    // on redirige vers la page home
                    header("Location: ../home.php");
                } else {
                    header("Location: ../login.php?erro=Email ou mot de passe incorrect");
                    exit();
                }
            }
        }
    }
}
