<?php
    require_once("query/product_function.php");
    require_once("query/profile_functions.php");
    require_once("query/cart_functions.php");
    require_once("query/new_account.php");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>
    <?php 
        include_once('component/nav-bar/nav-bar.php');
        include_once('component/header/header.php');
        include_once('component/login/login.php');
    ?>

    <?php include_once('component/footer/footer.php'); ?>
</body>
</html>