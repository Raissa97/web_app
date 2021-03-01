<?php include("../login/db.php");
    
if(isset($_POST['name'])){
    $name=filter_var($_POST['name'], FILTER_SANITIZE_STRING);
} if(isset($_POST['email'])){
    $email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
} if(isset($_POST['password'])){
    $psw=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
}if(isset($_POST['password2'])){
        $psw2=filter_var($_POST['password2'], FILTER_SANITIZE_STRING);
}

$conn=db();
$rows= mysqli_query($conn, "SELECT email FROM utenti WHERE email= '".$email."' limit 1");
$arr_res= mysqli_fetch_all($rows);
if(isset($_POST['sign-up'])){
    if(count($arr_res)>0){
        //account exists in db
        $error="1";
        header("Location: newacc.php?$error");
    } else{
        //password not confirmed
        if($psw != $psw2){
            $error="2";
            header("Location: newacc.php?$error");
        }else{
            //insert this users into db
            $password = md5($psw);
            $sql=mysqli_query($conn,"INSERT INTO utenti(nome,email,password) VALUES('$name','$email','$password')");
            header("Location: ../login/login-form.php");
        }
    }
}
?>