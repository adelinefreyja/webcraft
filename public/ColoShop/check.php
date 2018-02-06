<?php
if( isset($_POST['produit']) && isset($_POST['quantite']) && isset($_POST["prix"]) ){

    session_start();
    $_SESSION["panier"]["produit"] = "";
    $_SESSION["panier"]["quantite"] = "";
    $_SESSION["panier"]["prix"] = "";
    $_SESSION["panier"]["produit"] = $_POST['produit'];
    $_SESSION["panier"]["quantite"] = $_POST['quantite'];
    $_SESSION["panier"]["prix"] = $_POST['prix'];

    echo "success";
}
