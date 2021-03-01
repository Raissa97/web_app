 <?php 
function printTable($query){
    $conn = db();
    $count=0;
    $res = mysqli_query($conn, $query);
    
    foreach($res as $result){
        $count++;
        $band[$count]=$result['band'];
        $band_id[$count]=$result['id'];
    }
    if($count>0){?>
    <div id="welcome">BANDS</div>
        <table class="table-bordered">
  <?php for($i=1;$i<$count+1;$i++){ ?>
            <tr>
                <td><?=$band[$i]?>
                    <input type="button" value="View concerts of <?=$band[$i]?>" onclick="document.location='index.php?<?= $band_id[$i]?>';">
                </td>
            </tr>
        <?php
        } ?> 
        </table>
        <?php
    } else { echo "ERROR"; }
}

function getAllBandsId(){
    $conn = db();
    $count=0;
    $query="SELECT id FROM bands WHERE 1 ORDER BY band";
    $res = mysqli_query($conn, $query);
    
    foreach($res as $result){ 
        $count++;
        $id[$count]=$result['id'];
    } 
    if($count>0){?>
        <?php 
        for($i=1;$i<$count+1;$i++){ 
            $x[$i]=$id[$i];
        }
    }
    return $x;
}

function printConcerts($x){
    $conn=db();
    $count=0;
    $query="SELECT id, luogo, data, prezzo FROM `concerti` WHERE band_id = '".$x."' ORDER BY band";
    $res= mysqli_query($conn, $query);
    foreach($res as $concerts){
        $count++;
        $id_conc[$count]=$concerts['id'];
        $place[$count]=$concerts['luogo'];
        $date[$count]=$concerts['data'];
        $price[$count]=$concerts['prezzo'];
    }
    if($count>0){?>
    <p id="welcome">CONCERTS OF <?= getBandFromId($x)?></p>
    <table class="table">
        <tr>
          <th>PLACE</th>
          <th>DATE</th>
          <th>PRICE</th>
          <th id="buy">BUY</th>
        </tr>
        <?php for($i=1;$i<$count+1;$i++){ ?>
            <tr>
                <td><?= $place[$i]?></td>
                <td><?=$date[$i]?></td>
                <td><?=$price[$i] ?></td>
                <td><a href="cart/cart.php?<?=$id_conc[$i]?>">add to cart</a></td>
            </tr>
            
        <?php
        } ?></table>
    <?php }   
}
function getBandFromId($id){
    $conn=db();
    $query="SELECT band FROM concerti WHERE band_id='".$id."' LIMIT 1";
    $res = mysqli_query($conn, $query);
    $res2= mysqli_fetch_all($res);
    
    if(count($res2)==1){
        $band=$res2[0][0];
    }return $band;
}
function getIdFromBand($band){
    $conn=db();
    $query="SELECT band_id FROM concerti WHERE band='".$band."' LIMIT 1";
    $res = mysqli_query($conn, $query);
    $res2= mysqli_fetch_all($res);
    
    if(count($res2)==1){
        $band2=$res2[0][0];
    }
    print_r($band2);
    return $band2;
}
?>