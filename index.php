<html> 
    <?php include "style/top.php"; include"login/db.php"; include "function.php"?>
    <head>
        <meta charset="UTF-8">
        <title>Black Rose TICKETS</title>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src='bootstrap-js/bootstrap.js'></script>
    </head>
    <body>
    <?php if(isset($_SESSION['login'])){
        if(isset($_SESSION['name'])){
            $name=$_SESSION['name']; ?>
            <div class='container-fluid'>
                <div class="container" id="welcome"> 
                Welcome back to <animation>Black Rose Tickets</animation> <?=$name ?>!!
            </div>
    
    <br> 
    <div id="cent">
        1) Select the band you love! <br>
        2) View the concerts of your favourite band and add them to your cart. <br>
        3) Enjoy your experience and rate us
    
        <?php $query = "SELECT band, id FROM bands WHERE 1 ORDER BY band";
         ?>
    </div>
    
    <div class="container">
        <br>
        <div class="form-group">
            <div class='input-group'>
                <span>Search a band:</span>
                <input type='text' id='search-txt' placeholder="band" class='form-control'>
            </div>
        </div>
        <br>
        <div id='res'></div>
    </div>
    
    <?php
        $x= getAllBandsId();
               
        for($i=1; $i<34;$i++){ //if a band is selected
            if(isset($_GET["$x[$i]"])){
              printConcerts($x[$i]);
            }
        } 
        printTable($query);
        
      }
    } else if(isset($_GET["err"])){?>
        <div id="welcome">
            <animation>Black Rose Tickets</animation> warns you:
            please<a href="login/login-form.php"> LOG IN !!! </a>
        </div> 
        <?php
      } else{ ?>
        <div id="welcome">
            Welcome to <animation>Black Rose Tickets</animation>. If you want to buy a ticket,
            please<a href="login/login-form.php"> log in </a>
        </div> 
        <?php $query = "SELECT band, id FROM bands WHERE 1 ORDER BY band";
        printTable($query);
    }
    ?>   
    </div>
    </body>
    <?php    include "style/bottom.html" ?>
</body>
</html>
<script> //function for search with ajax
     $(document).ready(function(){
         $("#search-txt").keyup(function(){
            var txt = $(this).val();
            if(txt !== ''){
                $.ajax({
                    url:"search.php",
                    method:"get",
                    data:{search:txt},
                    dataType:"text",
                    success:function(data){
                        $('#res').html(data);
                    }
                });
            }else{
                $('#res').html('');
            }
         });
     });
</script>
