<?php
session_start();

switch ($_GET['action']){
    case 'add';
        if(isset($_POST['submit'])){

            $name = filter_input(INPUT_POST, "name" , FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, "price" , FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $qtt = filter_input (INPUT_POST,"qtt",FILTER_VALIDATE_INT);

        if($name && $price && $qtt){

            $product = [
                "name" =>$name,
                "price"=> $price,
                "qtt" =>$qtt,
                "total" => $price*$qtt
                        ];

        $_SESSION['products'][] = $product;
                
            }
        }


        header("Location:index.php"); 
		break;

        /* action de supprimer tout le panier*/
        case "supp":
            unset($_SESSION["products"]);
            header("Location:recap.php");
            break;

        /* ajouter par 1*/
        case "plus":
            if(isset($_SESSION["products"])) 
                {
                    $_SESSION["products"][$_GET["index"]]["qtt"]++;
                    $_SESSION["products"][$_GET["index"]]["total"]+= 
                    $_SESSION["products"][$_GET["index"]]["price"];
                    header("Location: recap.php");
                }
                break;

        /*  supprimer par 1*/
        case "moin":
            if(isset($_SESSION["products"]))
                {
                    $_SESSION["products"][$_GET["index"]]["qtt"]--;
                    $_SESSION["products"][$_GET["index"]]["total"] -= 
                    $_SESSION["products"][$_GET["index"]]["price"];
                        if($_SESSION["products"][$_GET["index"]]["qtt"] == 0){
                        unset($_SESSION["products"][$_GET["index"]]);
                        }
                        header("Location: recap.php");
                }
                    break;
		}

