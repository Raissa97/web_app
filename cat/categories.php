<?php 
include "../style/top.php";
include "methods-cat.php"; 

if(isset($_SESSION['login'])){
  if(isset($_SESSION['name'])){

?>
<br>
<p id="cent">1) Select a band or a category<br>
2) View concerts and buy the one you want to participate.</p>
    <div class="row">
    <div class="col-sm-2">
        <p id="title">SELECT a category</p>
        <a href="categories.php?rock"><p>Hard Rock</a></p>
        <a href="categories.php?alt-r"><p>Alternative Rock</a></p>
        <a href="categories.php?alt"><p>Alternative Metal</a></p>
        <a href="categories.php?heavy"><p>Heavy Metal</a></p>
        <a href="categories.php?progr"><p>Progressive Rock</a></p>
        <a href="categories.php?nu"><p>Nu Metal</a></p>
        <a href="categories.php?trash"><p>Trash Metal</a></p>
        <a href="categories.php?death"><p>Death Metal</a></p>
    </div>

    <div  class="col-sm-8">
    <?php 
    $x= getAllBandsId();
    $query2 = "SELECT band, id FROM bands WHERE ";
    if(isset($_GET['rock'])){
        $type='rock';
        $query2 .= "genre = 'hard rock' ORDER BY band";
        printTable($query2,$type);
        //controlBand($query2);
    } else if(isset($_GET['alt-r'])){
        $type='alt-r';
        $query2 .= "genre = 'alternative rock' ORDER BY band";
        printTable($query2,$type);
        //controlBand($query2);
    } else if(isset($_GET['alt'])){
        $type='alt';
        $query2 .= "genre = 'alternative metal' ORDER BY band";
        printTable($query2,$type);
        //controlBand($query2);
    } else if(isset($_GET['heavy'])){
        $type='heavy';
        $query2 .= "genre = 'heavy metal' ORDER BY band";
        printTable($query2,$type);
        //controlBand($query2);
    } else if(isset($_GET['progr'])){
        $type='progr';
        $query2 .= "genre = 'progressive rock' ORDER BY band";
        printTable($query2,$type);
        //controlBand($query2);
    } else if(isset($_GET['nu'])){
        $type='nu';
        $query2 .= "genre = 'nu metal' ORDER BY band";
        printTable($query2,$type);
        //controlBand($query2);
    } else if(isset($_GET['trash'])){
        $type='trash';
        $query2 .= "genre = 'trash metal' ORDER BY band";
        printTable($query2,$type);
        //controlBand($query2);
    } else if(isset($_GET['death'])){
        $type='death';
        $query2 .= "genre = 'death metal' ORDER BY band";
        printTable($query2,$type);
        //controlBand($query2);
    }else if(isset($_GET["tot"])){
        $query = "SELECT band, id FROM bands WHERE 1 ORDER BY band";
        printTable($query);
    } else{
        for($i=1; $i<34;$i++){
          if(isset($_GET["$x[$i]"])){
            printConcerts($x[$i]);
          }
        }
    }
  }
}else { ?>
        <div id="welcome">You have to <a href="../login/login-form.php">log in</a> if you want to see this page.</div>
<?php }
?>
</div>
</div>
<?php



include "../style/bottom.html"; ?>
