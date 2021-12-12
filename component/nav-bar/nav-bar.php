<link rel="stylesheet" type="text/css" href="./component/nav-bar/nav-bar.css" />
<?php 
    if(!isset($_SESSION)) session_start(); 
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!empty($_GET['search'])){
            $_SESSION['search_keyword'] = $_GET['search'];
            header("Location: search-result.php");
        }
    }
?>
<div id="navi-bar-container">
<div id="navi-bar">
    <a href="index.php">
        <img src="images/hcmut.png" alt="" id="navi-bar-logo"/>
    </a>
    <a href="user-profile.php">
        <img src="images/user-icon.png" alt="" id="navi-bar-user"/>
    </a>
    <a href="cart.php">
        <img src="images/shopping-bag.png" alt="" id="navi-bar-shopping-bag"/>
        <span id="num-items">
        <?php
            if(isset($_SESSION['giohang'])){
                echo count($_SESSION['giohang']);
            }else{
                echo 0;
            }
        ?>
        </span>
    </a>
    <form method="get" name="sform" action="index.php" id="navi-bar-search">
        <input type="text" name="search" placeholder="Search..."/>
        <input type="submit" name="sbutton" value="" />
    </form>
    
</div>
</div>
<script>
// When the user scrolls down 20px from the top of the document, slide down the navbar
window.onscroll = function() {scrollFunction(); scrollFunction2();};

function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    document.getElementById("navi-bar-container").style.top = "0";
  } else {
    document.getElementById("navi-bar-container").style.top = "-50px";
  }
}
</script>