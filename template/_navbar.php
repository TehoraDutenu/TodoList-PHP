<nav id="navbar">
    <div class="navbar-header">
        <?php session_start() ?>
        <h5>Bienvenue</h5>
        <p> <?php echo $_SESSION['email'] ?> </p>
    </div>
    <div class="navbar-link">
        <div>
            <a href="../home.php">Accueil</a>
            <a href="../post.php">Tous les posts</a>
            <a href="../create_post.php">Ajouter un post </a>
        </div>
        <div>
            <!-- TODO: créer le fichier logout.php dans api -->
            <a href="#">Déconnection</a>
        </div>
    </div>
</nav>