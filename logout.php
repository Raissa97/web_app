<?php include "style/top.php"; 

print_r($_SESSION);
        if(isset($_SESSION)){
           session_destroy(); 
           header("Location: index.php");
        }
        
        
include "style/bottom.html"; ?>
