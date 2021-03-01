<?php include "../login/db.php";
function printCartFromId($id_user){
    $conn=db();
    $query1="SELECT bands.band, concerti.luogo, concerti.data, concerti.prezzo "
        ."FROM shop " 
        ."JOIN concerti ON concerti.id = shop.concert " 
        ."JOIN bands ON bands.id = concerti.band_id "
        ."JOIN utenti ON shop.user=utenti.id "
        ."WHERE shop.user=".$id_user."";
    $res1= mysqli_query($conn,$query1);
    $cont= mysqli_num_rows($res1);
    $result= mysqli_fetch_all($res1, MYSQLI_ASSOC);
    $count=0;
    if(!$res1){ 
        echo "BAD query";
    } else{
        $arr=$result;
        for($i=0;$i<$cont;$i++){
            $arr[$count]=$result[$i]['band'];
            $count++;
            $arr[$count]=$result[$i]['luogo']; //1
            $count++;
            $arr[$count]=$result[$i]['data'];
            $count++;
            $arr[$count]=$result[$i]['prezzo'];
            $count++;
            $count++;
        }
        if($cont>=2){
            printTable(2, $count, $arr, $id_user);
        } else if($cont==0){
            echo "SHOP is empty";
            header("Location:cart.php?err");
        } else if($cont==1){
            printTable(1, $count, $arr, $id_user);
        } else if($cont>2){?>
            <div id="error"> "You can't have more than 2 concerts in shopping cart";
            </div>
  <?php }
    }
}
function printTable($cont,$count,$arr,$id_user){
    $conn=db();
    if($cont==2){?>
        <div id="welcome">SHOPPING CART</div>
            <table class="table-bordered">
                <tr>
                    <th>BAND</th>
                    <th>PLACE</th>
                    <th>DATE</th>
                    <th>PRICE</th>
                    <th>DELETE</th>
                </tr>
                <tr>
          <?php $i=0;
                while($i<8){  //es 12/4 = 3
                    if($cont>1){
                        $band1=selectIdShop($id_user,0);
                        $bands= selectIdBand($band1);
                        //echo '<br><br>!!!!!!!!!!';print_r($bands);
                        while($i<4){
                            
                            if($i==0){
                                ?>
                                <td><?=$arr[$i]?></td>
                                <?php $i++;
                            } else{ ?>
                                <td><?=$arr[$i]?></td>
                                <?php $i++;
                            }
                        }
                        if($i==4){ ?>
                            <td><a href="cart.php?<?= $bands[0].'x'.$band1?>">delete</a></td>
                            <?php  $i++ ?>
                </tr><tr>
                <?php   }
                        $band2=selectIdShop($id_user,1);
                        $bbb= selectIdBand($band2);
                        //echo '<br><br>!!!!!!!!!!';print_r($bbb);
                        while($i>=5 && $i<=9){ 
                            if($i==5){?>
                                <td><?=$arr[$i]?></td>
                                <?php $i++;
                            }else if($i==9){ ?>
                                <td><a href="cart.php?<?=$bbb[0].'x'.$band2?>">delete</a></td>
                  <?php         $i++;
                            }else{ ?>
                                <td><?=$arr[$i]?></td>
                                <?php $i++;
                            }
                        }
                    }
                }
    }else if($cont==1){ 
        $i=0;
        $band=selectIdShop($id_user,0);
        //echo'<br><br><br><br> cont==1, select id shop:  <br>'.$band.'<br>';
        $x= selectIdBand($band);
        //echo'<br><br><br><br> cont==1, select id band:  <br>'.$x[0].'<br>';
        ?>
        
        <div id="welcome">SHOPPING CART</div>
            <table class="table-bordered">
                <tr>
                    <th>BAND</th>
                    <th>PLACE</th>
                    <th>DATE</th>
                    <th>PRICE</th>
                    <th>DELETE</th>
                </tr>
                <tr>
 <?php
        while($i<4){?>
            <td><?=$arr[$i]?></td>
            <?php $i++;
        }
        if($i==4){?>
            <td><a href="cart.php?<?=$x[0].'x'.$band?>">delete</a></td>
<?php        $i++;
        }
?>
        </tr>
<?php
    } else if($cont>2){ ?>
        <div id="error">You can't have more than 2 prenotations</div>
<?php }
    else{ ?>
        <div id="welcome">SHOPPING CART</div>
        <div id="error">Your shopping cart is empty!</div>
<?php }
?>
</table>
<?php           
    ?>
            
<?php //echo '<br><br><br><br><br><br><br><br>';
}

function idConc(){
    $conn= db();
    $query = "SELECT id FROM concerti WHERE 1 ORDER BY id";
    $result= mysqli_query($conn, $query);
    $i=0;
    foreach ($result as $res){
        $arr[$i]=$res['id'];
        $i++;
    }
    return $arr;
}

function idShop(){
    $conn= db();
    $query="SELECT id FROM shop WHERE 1 ORDER BY id";
    $res= mysqli_query($conn, $query);
    $i=0;
    foreach($res as $result){
        $arr[$i]=$result['id'];
        $i++;
    }
    return $arr;
}

function addToCart($id_user, $id_conc){
    $conn=db();
    $princ="SELECT id FROM shop WHERE user=$id_user";
    //echo '<br>query id  <br>'.$princ;
    $res1= mysqli_query($conn, $princ);
    $numConc = mysqli_num_rows($res1);
    //echo "<br> num rows <br> ".$numConc."<br>";
    if($numConc<2){
        $query="INSERT INTO shop(user,concert) VALUES($id_user,$id_conc)";
        //echo $query;
        $res2=mysqli_query($conn, $query);
        header("Location:cart.php?ok");
        //echo '<br> result ok<br>';
        //echo $res2=true;
        printCartFromId($id_user);
    } else{ ?>
        <div id="error">You can't have more than 2 concerts in the shopping cart</div>
    <?php }
}

function selectID($nome){
    $conn = db();
    $query="SELECT id FROM utenti WHERE nome='".$nome."' LIMIT 1";
    $res= mysqli_query($conn, $query);
    foreach($res as $result){
        $id_user=$result['id'];
    }
    return $id_user;
}

function selectIdShop($id_user, $int){
    $conn=db();
    $query="SELECT id FROM shop WHERE user=$id_user ORDER BY shop.id ASC";
    $res= mysqli_query($conn, $query);
    //print_r($res);
    $count=0;
    foreach($res as $result){
        $id[$count]=$result['id'];
        $count++;
    }
    //echo '<br> id:  <br>';
    //print_r($id);
    return $id[$int];
}

function selectIdBand($id_shop){
    $i=0;
    $j=0;
    $conn= db();
    $qu="SELECT concert FROM shop WHERE id=$id_shop";
    //echo '<br> select id conc from shop.. <br>'.$qu.'<br>';
    $ris= mysqli_query($conn, $qu);
    foreach($ris as $rr){
        $id[$j]=$rr['concert'];
        $j++;
    }
    //echo '<br> result select concert from shop id='.$id_shop.'<br>';
    //print_r($id);
    //echo '<br>';
    return $id;
}

function deleteFromShop($id_shop,$id_user){
    $conn= db();
    $query="DELETE FROM `shop` WHERE `shop`.`id` = $id_shop";
    $res= mysqli_query($conn, $query);
    if($res==true){
        echo "concert deleted";
        header("Location:cart.php");
    } else{
        echo "<br>not deleted";
    }
}
?>