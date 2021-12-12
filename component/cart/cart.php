<link rel="stylesheet" type="text/css" href="./component/cart/cart.css" />
<?php
    $usr = $_SESSION['user'];
    $user_carts = get_user_cart($usr);
    $user_profile = get_user_profile($usr);
    $total_price= 0;
    foreach ($user_carts as $cart){
        $total_price += $cart['total_price'];
    }
    $payment_price = $total_price - 30000;
    if($payment_price < 0)
        $payment_price = 0;
    if(isset($_POST['order'])){
        payment_cart($usr);
        echo '<script>alert("Order successfully, please check in  profile!");
        </script>';
        header("Refresh:0");
    }
    foreach ($user_carts as $cart){
        $name = 'abc' . $cart['cart_id'];
        if(isset($_POST[$name])){
            remove_cart($cart['cart_id']);
            echo '<script>alert("Delete successfully");
            </script>';
            header("Refresh:0");
        }
        $value = 'i'. $cart['cart_id'];
        if(isset($_POST[$value])){
            $quantity_id = 'cart'. $cart['cart_id'];
            $quantity = $_POST[$quantity_id] + 1;
            update_quantity($cart['cart_id'], $quantity);
            header("Refresh:0");
        }
        $value = 'd'. $cart['cart_id'];
        if(isset($_POST[$value])){
            $quantity_id = 'cart'. $cart['cart_id'];
            $quantity = $_POST[$quantity_id];
            if($quantity > 1){
                $quantity--;
                update_quantity($cart['cart_id'], $quantity);
                header("Refresh:0");
            }
        }
    }
?>
<div class="cart">
    <div class="cart-product">
        <div class="label">Cart</div>
        <table>
            <thead>
                <tr>
                    <th width="5%"> </th>
                    <th width="45%">Name</th>
                    <th width="15%">Price</th>
                    <th width="20%">Quantity</th>
                    <th width="15%">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $c_id = 0;
                 foreach ($user_carts as $cart) :?>
                <?php $images = explode(" ", $cart['product_image']);?>
                <tr>
                    <td>
                    <form method="POST">
                        <button class="rmv-btn" name="<?php echo 'abc'.$cart['cart_id'];?>" type="submit"><img src="images/x-icon.png" width="100%" /></button>
                    </form>
                    </td>
                    
                                    
                    <td>
                    <form method="POST">
                        <div class="item-img"><img src="images/product/<?php echo $images[0];?>" width="100%"/></div>
                        <div class="item-name"><?php echo $cart['product_title'];?></div>
                    </td>
                    <td class="price center"><?php echo $cart['product_price'];?></td>
                    <td class="center">
                        
                    <form method="POST">
                        <input type="hidden" name="<?php echo 'cart'.$cart['cart_id'];?>" value="<?php echo $cart['quantity'];?>"/>
                        <button type="submit" name="<?php echo 'd'.$cart['cart_id'];?>" class="quantity-btn">-</button>
                        <span class="quantity"><?php echo $cart['quantity'];?></span>
                        <button type="submit" name="<?php echo 'i'.$cart['cart_id'];?>" class="quantity-btn">+</button>
                    </form>
                    </td>
                    <td class="price center"><?php echo $cart['total_price'];?></td>
                </tr>
                <?php $c_id++;?>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="cart-cost">
        <div class="label">Address</div>
        <div class="cart-address">
            <p class="name"><?php echo $user_profile['name'];?></p>
            <p><i><?php echo $user_profile['phonenumber'];?></i></p>
            <p class="address">
                <?php echo $user_profile['address'];?>
            </p>
            <a href="user-profile.php" class="cart-btn">Change address</a>
        </div>
        <div class="label">Payment</div>
        <div class="cost-name">
            <span class="float-left">Total</span>
            <span class="price float-right"><?php echo $total_price;?></span>
        </div>
        <div class="cost-name">
            <span class="float-left">Transport Fee</span>
            <span class="price float-right">30000</span>
        </div>
        <div class="cost-name">
            <span class="float-left"><strong>Total</strong></span>
            <span class="price float-right"><?php echo $payment_price;?></span>
        </div>
        <form method="POST">
            <input class="cart-btn" id="order" name="order" value="Order" type="submit" />
        </form>
        
    </div>
</div>
<script>
formatPrice();

function formatPrice() {
    var prices = document.getElementsByClassName('price');
    for (price of prices) {
        if (!isNaN(Number(price.innerHTML))) {
            price.innerHTML = Number(price.innerHTML).toLocaleString("vi-VN", {
                style: 'currency',
                currency: 'VND'
            });
        }
    }
}
</script>
