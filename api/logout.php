<?php
session_start();

// destruction de la session
session_destroy();
// on redirige vers la page de connexion
header("Location: ../login.php?error=Vous avez été déconnecté");
