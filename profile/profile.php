<?php include "../style/top.php";
 include "../login/db.php";
//include "changePsw.php"; ?>
<div class='row'>
        <div class='col-sm-3'>
        <img src="../img/logo.png" alt="img-profile"/>
        </div>
        <?php
        if(isset($_SESSION['login']) && isset($_SESSION['name'])){
            $name = $_SESSION['name'];
            $conn = db();
            $query= mysqli_query($conn, "SELECT * FROM utenti WHERE nome = '".$name."'");        
            $arr_res= mysqli_fetch_all($query);
        
            if(count($arr_res)==1){ ?>
            <div class='col-sm-8'>
            <table class='table'>
                <tr><td>Name:</td><td> <?= $arr_res[0][0]; ?></td></tr>
                <tr><td>E-mail:</td><td> <?= $arr_res[0][1]; ?></td></tr>
            </table>
            </div>
                    <?php
            } ?>
            <div class='psw'>
            <h1>Change password:</h1>
            <form method='post' action='changePsw.php' class='form-inline'>
                <input type='password' name="oldp" placeholder='old password' required="required">
                <input type='password' name="newp" placeholder='new password' required="required"><br>
                <input type ='submit' name="change" value='change password'>
            </form>
            </div>
            <?php
            if(isset($_GET['1'])){ ?>
                <div id="error">
                    Old password is wrong or old and new passwords are not different!
                </div>
            <?php
            }
            if(isset($_GET['ok'])){ ?>
                <div id="ok">
                    Your password has been changed succesfully!
                </div>
            <?php 
            }
        }else { ?>
            <div class='col-sm-8'>
            <table class='table'>
                <tr><td>Name:</td><td>Your name</td></tr>
                <tr><td>E-mail:</td><td>Your email</td></tr>
            </table>
            <div id="error">
                You have to log in to see your profile!
            </div>
            </div>
            
            <?php
            } ?>
</div>
            
<?php include "../style/bottom.html"; ?>
