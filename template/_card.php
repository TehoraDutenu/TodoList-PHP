<?php


function all_card($row)
{
    // Formater le timestamp en date
    $date = date('d/m/Y', $row['created_at']);
?>
    <div class="card m-3" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title card_title"><?php echo $row['titre']; ?></h5>
            <p class="card-text"><?php echo $row['description']; ?></p>
            <p class="card-text">
                <small class="text-muted">Crée le:
                    <span class="text_card fw-bold"><?php echo $date; ?></span>
                </small>
            </p>
            <p class="card-text">
                <small class="text-muted">Crée par:
                    <span class="text_card fw-bold"><?php echo $row['email']; ?></span>
                </small>
            </p>
        </div>
    </div>
<?php
}

function mine_cards($row)
{
    // Formater le timestamp en date
    $date = date('d/m/Y', $row['created_at']);
    // on va générer une URL encodée pour passer les paramètres en GET
    $param = http_build_query($row);
?>
    <div class="card m-3" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title card_title"> <?php echo $row['titre']; ?> </h5>
            <p class="card-text"> <?php echo $row['description']; ?> </p>
            <p class="card-text">
                <small class="text-muted">Crée le:
                    <span class="text_card fw-bold"> <?php echo $date; ?> </span>
                </small>
            </p>
            <p class="card-text">
                <small class="text-muted">Crée par:
                    <span class="text_card fw-bold"> <?php echo $row['email']; ?> </span>
                </small>
            </p>
            <div class="d-flex justify-content-around">
                <a class="post_update" href="../update_post.php? <?php echo $param ?> ">
                    <p class="card-text"><i class="bi bi-pencil"></i></p>
                </a>
                <a class="post_delete" href="../api/delete_post.php?id=<?php echo $row['id'] ?>">
                    <p class="card-text"><i class="bi bi-trash"></i></p>
                </a>
            </div>
        </div>
    </div>
<?php
}
