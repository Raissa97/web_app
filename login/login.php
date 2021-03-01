<?php
session_start();

include "methods.php"; 


if(isset($_POST['submit'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password= filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $login="";
    $name="";
    
    $conn= mysqli_connect('localhost', 'root', '', 'blackrose');
    $sql= mysqli_query($conn, "SELECT nome FROM utenti WHERE email='".$email."'");
    $arr_res= mysqli_fetch_all($sql);
    
    if(verify_psw($email, $password)==true){
        //login success
        if(count($arr_res)==1){
        $login="LOG OUT";
        $name=$arr_res[0][0];
        $_SESSION['name']=$name;
        $_SESSION['login']=$login;
        header("Location: ../index.php");
        }
    } else{
        //login failure
        $login="LOG IN";
        header("Location: login-form.php?error");
    }
}
?>