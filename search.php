<?php include "login/db.php";include "function.php";
$conn=db();
$print='';
$query="SELECT band, band_id, id, luogo, data, prezzo FROM `concerti` WHERE band LIKE '%".$_GET["search"]."%'"; 
$res= mysqli_query($conn, $query);
$rows= mysqli_num_rows($res);
foreach ($res as $result){
    $x=$result['band'];
} 
if($rows>0){
    $id=getIdFromBand($x);
    printConcert($id);
} else{ ?>
    <div id=error>this band doesn't exists.</div>
<?php
}
?>