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

    // Maintenant que nos données sont réceptionnées et sécurisées
    // On va effectuer plusieurs traitements
    // 4- Gestion des erreurs
    // On vérifie que l'email est rempli
    if (empty($email)) {
        // On revoie en GET à index.php le paramètre ?error=Veuillez saisir l'email"
        header("Location: ../login.php?error=Veuillez saisir l'email");
        exit();
    } else if (empty($password)) {
        // On revoie en GET à index.php le paramètre ?error=Veuillez saisir le mot de passe"
        header("Location: ../login.php?error=Veuillez saisir le mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // On revoie en GET à index.php le paramètre ?error=Veuillez saisir un email valide"
        header("Location: ../login.php?error=Veuillez saisir un mail valide");
        exit();
    } else {
        // On va vérifier que l'utilisateur existe bien dans la BDD
        global $mysqli;

        // On crée la requete sql
        $query = "SELECT * FROM user WHERE email = '$email'";

        // On execute la requete
        if ($result = mysqli_query($mysqli, $query)) {
            // On regarde si on a un résultat qui sort

            if (mysqli_num_rows($result) < 1) {

                // On ferme la connexion
                mysqli_close($mysqli);

                // On redirige
                header("Location: ../login.php?error=Email et/ou mot de passe incorrect");
                exit();
            }
            // Si on a un résultat on vérifier le combo email / mot de passe
            while ($user = mysqli_fetch_assoc($result)) {
                if ($user['email'] === $email && password_verify($password, $user['password'])) {
                    // On peux créer la session
                    session_start();

                    // On va stocker l'email et l'id de l'utilisateur dans la session
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['id'] = $user['id'];

                    // On ferme la connexion
                    mysqli_close($mysqli);

                    // On redirige sur la page home.php
                    header("Location: ../home.php");
                } else {

                    // On ferme la connexion
                    mysqli_close($mysqli);

                    // On redirige
                    header("Location: ../login.php?error=Email et/ou mot de passe incorrect");
                    exit();
                }
            }
        }
    }
}
