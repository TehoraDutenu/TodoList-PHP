<?php

function get_all_posts()
{
    global $mysqli;

    $query_all = "SELECT p.id, p.titre, p.description, p.created_at, u.email 
                FROM post as p
                INNER JOIN user as u 
                ON p.user_id = u.id;";

    // On éxecute la requete
    $result = mysqli_query($mysqli, $query_all);

    // On vérifier si on a des résultats
    if (mysqli_num_rows($result) > 0) {

        // On boucle sur les résultats
        while ($row = mysqli_fetch_assoc($result)) {

            // On appelle la fonction card
            all_card($row);
        }
        // On ferme la connexion
        mysqli_close($mysqli);
    }
}

function get_my_posts($id)
{
    global $mysqli;

    $query_mine = "SELECT p.id, p.titre, p.description, p.created_at, u.email 
                FROM post as p
                INNER JOIN user as u 
                ON p.user_id = u.id
                WHERE u.id = $id;";

    // On éxecute la requete
    $result = mysqli_query($mysqli, $query_mine);

    // On vérifier si on a des résultats
    if (mysqli_num_rows($result) > 0) {

        // On boucle sur les résultats
        while ($row = mysqli_fetch_assoc($result)) {

            // On appelle la fonction card
            mine_cards($row);
        }
        // On ferme la connexion
        mysqli_close($mysqli);
    }
}
