<?php require_once './template/_header.php';
require_once './template/_navbar.php';
require_once './template/_card.php';


// On importe la config
require_once './api/config.php';

// On importe le fichier get_post.php
require_once './api/get_post.php';
?>

<main class="d-flex flex-column align-items-center">
    <h1>Tous mes posts</h1>
    <div class="d-flex col-10 flex-wrap justify-content-center">
        <?php
        get_my_posts($_SESSION['id']);
        ?>
    </div>
</main>

<?php require_once './template/_footer.php' ?>