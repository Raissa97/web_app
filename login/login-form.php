<?php include "../style/top.php" ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login</title>
    </head>
    <body>
        
        <form method="post" action="login.php">
            <fieldset>
                <legend>Enter NOW</legend>
                <h2>E-mail:</h2>
                    <input type="email" name="email" placeholder="e-mail" required="required" pattern="(^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z])">
                <h2>Password:</h2>
                    <input type="password" name="password" placeholder="password" required="required">
                    <br>
                    <input type="submit" name="submit" value="LOG IN"> <br>
                <?php
                if(isset($_GET['error'])){ ?>
                    <div id="error">
                        incorrect password or e-mail
                    </div>
                <?php
                }?>
                <a href="/TWEB/TWEBproject/account/newacc.php">... or Create new account</a>
            </fieldset>
        </form>
    </body>
    <?php include "../style/bottom.html"; ?>
</html>
