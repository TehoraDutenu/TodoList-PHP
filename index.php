<?php
// On importe le header
require_once './template/_header.php';
require_once './template/_form.php';

// On demarre la session
session_start();
if (isset($_SESSION['email'])) {
    // On redirige sur la page home.php
    header("Location: ../home.php");
    exit();
} else {
    form(
        "Créer un compte",
        "./api/registration.php",
        "S'enregistrer",
        "Vous avez déjà un compte ?",
        "./login.php",
        "Connectez-vous"
    );
}

// FORMULAIRE D'INSCRIPTION EN DUR
// <div id="wrapper">
//     <form action="" method="post">
//         <h2>Créer un compte</h2>
//         <label for="email">Email</label>
//         <input type="text" name="email" placeholder="Votre email">
//         <label for="password">Mot de passe</label>
//         <input type="text" name="password" placeholder="Votre mot de passe">
//         <div class="box_button">
//             <button type="submit">S'enregistrer</button>
//             <p class="sub_text"> Vous avez déjà un compte ?
//                 <a href="./login.php" class="link">Connectez-vous</a>
//             </p>
//         </div>
//     </form>
// </div>

// On importe le footer 
require_once './template/_footer.php';
