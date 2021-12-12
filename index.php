<!DOCTYPE html>
<html lang="en">
<?php
    require_once("query/product_function.php");
    require_once("query/profile_functions.php");
    require_once("query/cart_functions.php");
    require_once("query/new_account.php");
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eComponent</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
</head>

<body>
    <?php
    include_once('component/nav-bar/nav-bar.php');
    include_once('component/header/header.php');
    include_once('component/banner/banner.php');
    ?>
    <div class="category">
        <hr /> Headphone
        <hr />
    </div>
    <?php 
    $cate_id = 1;
    if(!isset($_SESSION)) session_start(); 
    if(!isset($_SESSION['cate_id']) || $_SESSION['cate_id'] != $cate_id) {
        $_SESSION['cate_id'] = $cate_id;
    }
    include('component/product-list/product-list.php'); ?>
    <div class="category">
        <hr /> PHone
        <hr />
    </div>
    <?php
    $cate_id = 3;
    if(!isset($_SESSION)) session_start(); 
    if(!isset($_SESSION['cate_id']) || $_SESSION['cate_id'] != $cate_id) {
        $_SESSION['cate_id'] = $cate_id;
    }
    include('component/product-list/product-list.php'); ?>
    <?php
    include_once('component/footer/footer.php');
    include_once('component/back-to-top/back-to-top.php');
    ?>
</body>

</html>