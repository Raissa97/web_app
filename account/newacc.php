<?php include "../style/top.php"; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>create account</title>
    </head>
    <body>
        <form method="post" action="acc.php">
            <fieldset>
                <legend>Create new account:</legend>
                <h2>Name:</h2>
            <input type="name" name="name" placeholder="name" required="required">
            <h2>E-mail:</h2>
            <input type="email" name="email" placeholder="your e-mail" required="required">
            <h2>Password:</h2>
            <input type="password" name="password" placeholder="your password" required="required">
            <h2>Confirm password:</h2>
            <input type="password" name="password2" placeholder="confirm password" required="required">
            <br>
            <input type="submit" name="sign-up" value="SIGN UP"> <br>
        <?php
        if(isset($_GET['1'])){ ?>
            <div id="error">
                this account exists yet
            </div>
        <?php
        } else if(isset($_GET['2'])){ ?>
            <div id="error">
                incorrect password
            </div>
        <?php
        }
        ?>
            <a href="../login/login-form.php">... or log in</a>
            </fieldset>
        </form>
        
    </body>
    <?php include "../style/bottom.html" ?>
</html>
