





<body>
    
    <?php
    session_start();
    ob_start();
    /* verifier si la session existe et non vide*/
    if(!isset($_SESSION['products']) || empty ($_SESSION['products']))
    {
        echo "<p>Aucun produit en session...</p>";
    }
    else {
        echo "<table  class='table table-bordered'>",
            "<thead class='table-light' >",
                "<tr>",
                    "<th >#</th>",
                    "<th scope='col '>Nom</th>",
                    "<th scope='col '>Prix</th>",
                    "<th scope='col '>Quantité</th>",
                    "<th >Total</th>",
                "</tr>",
            "</thead>",
            "<tbody>";
    $totalGeneral = 0;
    /*parcourire la session */
    foreach ($_SESSION['products'] as $index => $product)
    {
        echo "<tr >",
            "<td>".$index."</td>",

            "<td>".$product['name']."</td>",

            "<td>".number_format($product['price'], 2, ",","&nbsp;")."&nbsp;€</td>",

            "<td><a style='text-decoration: none;' href='traitement.php?action=moin&index=" . $index . "'>-</a>" . $product["qtt"] .
            
                "<a style='text-decoration: none;' href='traitement.php?action=plus&index=" . $index . "'>+</a>
            </td>",
            
            "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
            "</tr>";
    $totalGeneral += $product['total'];
    }
    echo "<tr>",
            "<td colspan= 4>Total général : </td>",
            "<td><strong>". number_format($totalGeneral, 2,",", "&nbsp;")."&nbsp;€</strong></td>",
            
            "</tr>";

            
        }
    $titre = "voir produit";
    $contenu = ob_get_clean();

    require_once "template.php";
        ?>
       
    </body>
    <footer>
    <label class="d-flex p-2" >
        <a href="index.php" class="p-3 mb-2 bg-primary text-white">Ajouter encore un produit</a> 
    </label>
    <!--bouton supprime tout le panier-->
    <label class="d-flex p-2">
        <a href='traitement.php?action=supp'class="p-3 mb-2 bg-primary text-white">Vider le panier</a>
    </label>
</footer>
    
