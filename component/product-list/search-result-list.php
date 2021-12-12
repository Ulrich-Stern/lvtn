<link rel="stylesheet" type="text/css" href="./component/product-list/product-list.css" />
<?php
    if(!isset($_SESSION)) session_start();
    if (!isset($_SESSION['search_keyword'])){
        header("Location: index.php");
    }
    $products = search_products();
?>
<div id="product-container">
    <div id="search-msg">Keyword: <?php echo $_SESSION['search_keyword'] ?></div>
    <?php foreach ($products as $product): ?>
        <?php $images = $product['product_image'];
            $image = explode(" ", $images);?>
        <a class="product-card" href="detail.php" onclick="location.href=this.href+'?id='+<?php echo $product['product_id'];?>;return false;">
            <img src="images/product/<?php echo $image[0]; ?>" width=100%/>
            <div class="product-name"><?php echo $product['product_title']; ?></div>
            <div class="product-price"><?php echo $product['product_price']; ?></div>
        </a>
    <?php endforeach; ?>
</div>

<script>
    formatPrice();
    function formatPrice()
    {
        var prices = document.getElementsByClassName('product-price');
        for (price of prices) {
            if (!isNaN(Number(price.innerHTML))){
                price.innerHTML = Number(price.innerHTML).toLocaleString("vi-VN", {
                    style: 'currency', currency: 'VND'
                });
                price.style.color = 'red';
            }
        }
    }
</script>