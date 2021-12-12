<!DOCTYPE html>
<html lang="en">
<?php
    require_once("query/product_function.php");
    require_once("query/profile_functions.php");
    require_once("query/cart_functions.php");
    require_once("query/new_account.php");
    
    $cate_id = intval($_GET['id']);
    if(!isset($_SESSION)) session_start(); 
    if(!isset($_SESSION['cate_id']) || $_SESSION['cate_id'] != $cate_id) {
        $_SESSION['cate_id'] = $cate_id;
    }
    $cate_name = get_category_name($cate_id);
    $products = get_products($cate_id)
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bach Khoa Clothes</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
</head>

<body>
    <?php
    include_once('component/nav-bar/nav-bar.php');
    include_once('component/header/header.php');
    include_once('component/banner/banner.php');
    ?>
    <div class="category">
        <hr /> <?php echo $cate_name['cate_title'];?>
        <hr />
    </div>
    <?php 
    if($products != 0) include('component/product-list/product-list.php');
    else
        echo '<div class="category"><div><br><br>No product here.</div></div>'; ?>
    <?php
    include_once('component/footer/footer.php');
    include_once('component/back-to-top/back-to-top.php');
    ?>
</body>

</html>