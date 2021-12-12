<link rel="stylesheet" type="text/css" href="./component/header/header.css" />
<?php 
    $avatar = "user-icon.png";
    if(!isset($_SESSION)) session_start(); 
    $loggedIn = false;
    if (isset($_SESSION['user'])){
        $loggedIn = true;
        $user = $_SESSION['user'];
        $user_profile = get_user_name_avatar($user);
        $avatar = $user_profile['avatar'];
    }
    $categories = get_categories();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!empty($_GET['search'])){
            $_SESSION['search_keyword'] = $_GET['search'];
            header("Location: search-result.php");
        }
    }
?>
<div id="page-header">
    <div id="contact-bar">
        Hotline: 0905 657 236 | Email: nguyen.vo1201@hcmut.edu.vn
    </div>
    <div id="header-content">
        <a href="index.php"><img src="images/hcmut.png" alt="" id="header-logo"/></a>
        <?php 
            if (!$loggedIn) echo '<a href="login.php" class="btn-login">Log in</a>';
            else echo '<a href="logout.php" class="btn-login btn-logout">Log out</a>';
        ?>
        <a href="user-profile.php">
            <img src="images/<?php echo $avatar; ?>" alt="" id="header-user"/>
        </a>
        
        <a href="cart.php">
            <img src="images/shopping-bag.png" alt="" id="header-shopping-bag"/>
            <span id="header-num-items">
            <?php
                if(isset($_SESSION['giohang'])){
                    echo count($_SESSION['giohang']);
                }else{
                    echo 0;
                }
            ?>
            </span>
        </a>
        <form method="get" name="sform" id="header-search">
            <input type="text" name="search" placeholder="Search..."/>
            <input type="submit" name="submit" value="" />
        </form>
    </div>
    <div id="redirect-bar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li class="dropdown-menu">
                <a href="index.php">Product</a>
                <div class="dropdown-content">
                    <?php foreach ($categories as $category):?>
                    <a href="category.php" onclick="location.href=this.href+'?id='+<?php echo $category['cate_id'];?>;return false;"><?php echo $category['cate_title'];?></a>
                    <?php endforeach; ?>
                </div>
            </li>
            <!-- <li><a href="about-us.php">About us</a></li>
            <li><a href="contact-us.php">Contact</a></li> -->
        </ul>
    </div>
</div>