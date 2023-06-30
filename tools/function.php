<?php

function validate($data)
{
    $data1 = trim($data); // supprime les espaces avant ou après la saisie
    $data2 = stripslashes($data1); // supprime les antislashs
    $data3 = htmlspecialchars($data2); // convertit les caractères spéciaux en string
    return $data3;
}
