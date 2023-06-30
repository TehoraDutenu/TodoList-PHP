<?php require_once './template/_header.php' ?>
<?php require_once './template/_navbar.php' ?>
<?php require_once './template/_card.php' ?>

<main class="d-flex flex-column align-items-center">
    <h1>Tous les posts</h1>
    <div class="d-flex col-10 flex-wrap justify-content-center">

        <?php
        // on importe la config
        require_once './api/config.php';
        // on importe le fichier get_post.php
        require_once './api/get_post.php';
        // on appelle la fonction get_all_posts
        get_all_posts();

        ?>
    </div>
</main>


<?php require_once './template/_footer.php' ?>