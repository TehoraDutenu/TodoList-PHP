<?php require_once './template/_header.php';
require_once './template/_navbar.php'; ?>

<main>
    <h1>Ajouter un post</h1>
    <div class="col-12 d-flex flex-column align-items-center p-2">
        <form action="./api/add_post.php" method="post">
            <!-- Gestion des erreur -->
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error'] ?></p>
            <?php } ?>
            <!-- Input pour le titre -->
            <label for="titre">Titre</label>
            <input type="text" name="titre" placeholder="Titre du post">
            <!-- Text Area pour la description -->
            <div class="d-flex flex-column mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description du post"></textarea>
            </div>
            <!-- Button type submit -->
            <div class="box_button">
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</main>

<?php require_once './template/_footer.php'; ?>