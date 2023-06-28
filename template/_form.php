<?php
function form($title, $action, $button_name, $text, $link, $button_link)
{
?>
    <div id="wrapper">
        <form action="<?php echo $action ?>" method="post">
            <h2> <?php echo $title ?> </h2>
            <!-- Pour l'affichage des erreurs -->
            <!-- le principe : renvoyer l'erreur à travers l'url au retour du serveur -->
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET['error'] ?> </p>
            <?php } ?>

            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Votre email">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" placeholder="Votre mot de passe">
            <div class="box_button">
                <button type="submit"> <?php echo $button_name ?> </button>
                <p class="sub_text"> <?php echo $text ?>
                    <a href="<?php echo $link ?>" class="link"> <?php echo $button_link ?> </a>
                </p>
            </div>
        </form>
    </div>


<?php
}

?>

<?php
