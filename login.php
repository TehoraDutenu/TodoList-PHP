<!-- On imprte le header -->
<?php require_once './template/_header.php' ?>
<?php require_once './template/_form.php' ?>

<!-- <h1>Premier site PHP</h1> -->

<!-- FORMULAIRE D'INSCRIPTION EN DUR -->
<!-- <div id="wrapper">
    <form action="" method="post">
        <h2>Se connecter</h2>
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Votre email">
        <label for="password">Mot de passe</label>
        <input type="text" name="password" placeholder="Votre mot de passe">
        <div class="box_button">
            <button type="submit">S'enregistrer</button>
            <p class="sub_text">Vous n'avez pas de compte ?
                <a href="./index.php" class="link">Inscrivez-vous</a>
            </p>
        </div>
    </form>
</div> -->

<?php
form(
    "Se connecter",
    "./api/authentication.php",
    "Se connecter",
    "Pas encore de compte ?",
    "./index.php",
    "Inscrivez-vous"
)
?>


<!-- On importe le footer -->
<?php require_once './template/_footer.php' ?>