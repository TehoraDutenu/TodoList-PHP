<nav id="navbar">
    <div class="navbar-header">
        <?php session_start();
        if (!isset($_SESSION['email'])) {
            // On redirige sur la page index.php si la session existe pas
            header("Location: ../index.php");
            exit();
        }
        ?>
        <h5>Bienvenue</h5>
        <p><?php echo $_SESSION['email'] ?></p>
    </div>
    <div class="navbar-link">
        <div>
            <a href="../home.php">Accueil</a>
            <a href="../post.php">Tous les posts</a>
            <a href="../create_post.php">Ajouter un post</a>
        </div>
        <div>
            <!-- TODO: Créer le fichier logout.php dans api -->
            <a href="../api/logout.php">Déconnexion</a>
        </div>
    </div>
</nav>