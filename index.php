<!-- On imprte le header -->
<?php require_once './template/_header.php' ?>
<?php require_once './template/_form.php' ?>

<!-- on démarre la session -->
<?php
session_start();
// on regarde si une session existe
if (isset($_SESSION['email'])) {
    // si oui, on redirige vers home
    header("Location: ./home.php");
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


?>

<!-- <h1>Premier site PHP</h1> -->

<!-- FORMULAIRE D'INSCRIPTION EN DUR -->
<!-- <div id="wrapper">
    <form action="" method="post">
        <h2>Créer un compte</h2>
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Votre email">
        <label for="password">Mot de passe</label>
        <input type="text" name="password" placeholder="Votre mot de passe">
        <div class="box_button">
            <button type="submit">S'enregistrer</button>
            <p class="sub_text">Vous avez déjà un compte ?
                <a href="./login.php" class="link">Connectez-vous</a>
            </p>
        </div>
    </form>
</div>  -->

<!-- On importe le footer -->
<?php require_once './template/_footer.php' ?>