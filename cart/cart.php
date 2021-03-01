<?php 
include "../style/top.php";
include "function-cart.php"?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(isset($_SESSION['login'])){
            if(isset($_SESSION['name'])){
                $nome=$_SESSION['name'];
                $id_user=selectId($nome);
                $idShop= idShop();
                $id_conc= idConc(); //all id conc
                for($i=0;$i<count($id_conc);$i++){
                    if(isset($_GET[$id_conc[$i]])){
                        //echo '<br><br>'.$id_conc[$i].'  da aggiungere a db';
                        addToCart($id_user,$id_conc[$i]);
                        //echo "<br> added to cart (  conc: ".$id_conc[$i]."  i=".$i."  , user  ". $id_user.")<br>";
                    }
                    for($j=0;$j<count($idShop);$j++){
                        if(isset($_GET[$id_conc[$i].'x'.$idShop[$j]])){
                                echo '<br> I HAVE TO DELETE SHOP NUMBER '.$idShop[$j];
                                deleteFromShop($idShop[$j],$id_user);
                        }
                    }
                }
                if(isset($_GET['ok'])){
                    printCartFromId($id_user);
                }else {
                    if(isset($_GET['err'])){?>
                        <div id='error'>Your cart is empty</div>
            <?php   }else{
                        printCartFromId($id_user);
                    }
                }
            }
        }else { ?>
        <div id="welcome">You have to <a href="../login/login-form.php">log in</a> if you want to see this page.</div>
<?php }
        ?>
    </body>
    <?php include "../style/bottom.html";?>
</html>
