<?php require_once './template/_header.php' ?>
<?php require_once './template/_navbar.php' ?>
<?php session_start();

// on vérifie si une session existe
if (!isset($_SESSION['email'])) {
    // si non, on redirige vers home
    header("Location: ./home.php");
    exit();
}

?>

<h1>HELLO HOME <?php echo $_SESSION['email'] ?> </h1>

<?php require_once './template/_footer.php' ?>