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
                "total" => $price*$qtt,
                "image"=>$name,

                        ];

        $_SESSION['products'][] = $product;
                
            }
        }
        /*on vérifie si l’index « file » existe*/
        if(isset($_FILES['file'] )&& !empty($_FILES["image"])){
            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];
            $type = $_FILES["file"]["type"];
            
            $tabExtension = explode('.', $name);
            // move_uploaded_file($tmpName, './upload/'.$name);
            $extension = strtolower(end($tabExtension));
            //Tableau des extensions que l'on accepte
            

            if(in_array($extension, $extensions))
                {
             move_uploaded_file($tmpName, './upload/'.$name);
                }
            else{
                    echo "Mauvaise extension";
                }

        }

        //Vérifier s’il y a une erreur
        $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            $maxSize = 400000;
        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
            move_uploaded_file($tmpName, './upload/'.$name);
        }
        else{
            echo "Une erreur est survenue";
        }

        if(in_array($extension, $extensions) && $size <= $maxSize){
            move_uploaded_file($tmpName, './upload/'.$name);
        }
        else{
            echo "Mauvaise extension ou taille trop grande";
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
        require_once "upload";
