<?php session_start(); ?>
<div class='container-fluid'>
    <div class='list-inline'>
        <a class='list-inline-item' href="/TWEB/TWEBproject/index.php">Home</a>
        <a class='list-inline-item'
            <?php
                if(isset($_SESSION['login'])==true){ ?>
                    href="/TWEB/TWEBproject/logout.php"> LOG OUT</a>
              <?php
                } else{?>
                    href='/TWEB/TWEBproject/login/login-form.php'> LOG IN</a>
          <?php }
            ?>                        
        <a class='list-inline-item' href="/TWEB/TWEBproject/profile/profile.php">
        <?php
            if(isset($_SESSION['name'])){
                $name=$_SESSION['name'];
                if(isset($_SESSION['login'])==true){ //la persona si è registrata correttamente
                    //print_r($_SESSION); 
                    echo $name;
                }
            } else{
                echo "Your Profile";
            }
            ?>
        </a>
        <a class='list-inline-item' href="/TWEB/TWEBproject/cart/cart.php">Shopping cart</a>
        <a class='list-inline-item' href="/TWEB/TWEBproject/cat/categories.php?tot">Categories</a>        
        <a class='list-inline-item' href="/TWEB/TWEBproject/about.php">About us</a>
        </div>
</div>