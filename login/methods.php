<?php include("db.php");

function verify_psw($email, $password){ 
    $psw = md5($password);
    $conn= db();
    $rows = mysqli_query($conn, "SELECT password FROM utenti WHERE email = '".$email."' limit 1");
      
    $arr_res= mysqli_fetch_all($rows);

    if(count($arr_res)==1){
        $password_ok = $arr_res[0][0];
        return $psw === $password_ok;
    } else {
        //print_r($arr_res);
        return false;   
    }
}

function get_email($nome){
    $conn=db();
    $query = mysqli_query($conn, "SELECT email FROM utenti WHERE nome = '".$nome."' LIMIT 1");
    $result= mysqli_fetch_all($query);
    
    $mail = $result[0][0];

    return $mail;
}

function verify($email,$old,$new){
    if(verify_psw($email,$old) == true && $old != $new){
        return true;
    } else if(verify_psw ($email, $old)==true && $old == $new){
        return false;
    } else{
        return false;
    }
}
?>