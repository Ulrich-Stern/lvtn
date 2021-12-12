<?php
    require_once('connect_to_server.php');
    function add_to_cart($usr, $product_id){
        global $db;
        $sql_cmd = "INSERT into cart (product_id, quantity, username, status) values ('$product_id', 1, '$usr', 'Unpaid')";
        $sql = mysqli_query($db, $sql_cmd);
        return 0;
    }
    function update_cart($usr, $product_id){
        global $db;
        $sql_cmd = "UPDATE cart set quantity = quantity + 1 where  product_id = '$product_id' and username = '$usr' and status = 'Unpaid'";
        $sql = mysqli_query($db, $sql_cmd);
        return 0;
    }
    function payment_cart($usr){
        global $db;
        $sql_cmd = "UPDATE cart set status = 'Paid' where username = '$usr'";
        $sql = mysqli_query($db, $sql_cmd);
    }
    function cart_checker($usr, $product_id){
        global $db;
        $sql_cmd = "SELECT * from cart where username = '$usr' and product_id = '$product_id' and status = 'Unpaid'";
        $sql = mysqli_query($db, $sql_cmd);
        
        $row = mysqli_num_rows($sql);
        if($row)
            return 1;
        return 0;
    }
    function get_user_cart($usr){
        global $db;
        $sql_cmd = "SELECT cart_id, product_image, product_title, product_price, quantity, (product_price*quantity) as 'total_price' from cart c, products p where c.username = '$usr' and c.product_id = p.product_id and c.status = 'Unpaid'";
        $sql = mysqli_query($db, $sql_cmd);
        
        $row = mysqli_num_rows($sql);
        return mysqli_fetch_all($sql, MYSQLI_ASSOC);
    }
    function get_user_paid_cart($usr){
        global $db;
        $sql_cmd = "SELECT c.product_id, product_title, quantity, (product_price*quantity) as 'total_price' from cart c, products p where c.username = '$usr' and c.product_id = p.product_id and c.status = 'Paid'";
        $sql = mysqli_query($db, $sql_cmd);
        
        $row = mysqli_num_rows($sql);
        return mysqli_fetch_all($sql, MYSQLI_ASSOC);
    }
    function remove_cart($id){
        global $db;
        $sql_cmd = "DELETE from cart where cart_id = '$id'";
        $sql = mysqli_query($db, $sql_cmd);
    }
    function update_quantity($id, $quantity){
        global $db;
        $sql_cmd = "UPDATE cart set quantity = '$quantity' where cart_id = '$id'";
        $sql = mysqli_query($db, $sql_cmd);
    }
?>