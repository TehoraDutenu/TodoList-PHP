<?php require_once './template/_header.php' ?>
<?php require_once './template/_navbar.php' ?>

<?php
// on reconstruit un tableau de données
$data = [
    "id" => $_GET['id'],
    "titre" => $_GET['titre'],
    "description" => $_GET['description']
];

?>

<!-- on crée le formulaire et on lui donne ses valeurs -->

<main>
    <h1>Modifier mon post</h1>
    <div class="col-12 d-flex flex-column align-items-center p-2">
        <form action="./api/edit_post.php" method="post">
            <!-- Gestion des erreur -->
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error'] ?></p>
            <?php } ?>
            <!-- input pour l'id -->
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
            <!-- Input pour le titre -->
            <label for="titre">Titre</label>
            <input type="text" name="titre" value="<?php echo $data['titre'] ?>">
            <!-- Text Area pour la description -->
            <div class="d-flex flex-column mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"> <?php echo $data['description'] ?></textarea>
            </div>
            <!-- Button type submit -->
            <div class="box_button">
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</main>



<?php require_once './template/_footer.php' ?>