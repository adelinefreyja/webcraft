<?php
if( isset($_POST['produit']) && isset($_POST['quantite']) ){

    session_start();
    $_SESSION["panier"]["produit"] = $_POST['produit'];
    $_SESSION["panier"]["quantite"] = $_POST['quantite'];

    echo "success";
}
