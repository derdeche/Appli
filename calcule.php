<?php
session_start();

$_SESSION['products'];

$nombreProduits = 0;


foreach ($_SESSION['products'] as $produit  ) 
{  
 $nombreProduits += $produit['qtt'];
}
return $nombreProduits;


