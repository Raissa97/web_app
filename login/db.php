<?php 
    function db(){
        $datab ='blackrose';
        $conn = mysqli_connect('localhost', 'root', '', $datab);
        return $conn;
    }
?>
