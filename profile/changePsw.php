<?php session_start();
include "../login/login.php";
 
if(isset($_SESSION['login'])){
    if(isset($_SESSION['name'])){
        $nome=$_SESSION['name'];
        $mail= get_email($nome);
        if(isset($_POST['change'])){
            $oldp= filter_var($_POST['oldp'], FILTER_SANITIZE_STRING);
            $newp= filter_var($_POST['newp'], FILTER_SANITIZE_STRING); 
      
            if(verify($mail,$oldp,$newp) == false){
                $error = "1";
                header("Location: profile.php?$error");
            } else if(verify($mail,$oldp,$newp) == true){
                $conn=db();
                $new = md5($newp);
                $sql="UPDATE utenti SET password = '".$new."' WHERE email = '".$mail."'";
                $ok = mysqli_query($conn, $sql);
                header("Location: profile.php?ok");
            }
        }
    }
}
   
?>
