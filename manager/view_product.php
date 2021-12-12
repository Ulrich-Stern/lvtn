<?php
    include_once '../query/connect_to_server.php';
?>

<div class="view-product-box">
    <h2>Xem sản phẩm</h2>
    <div class="border-bottom"></div>

    <form action="" method="post">
        <!-- <div class="search-bar">
            <input type="text" id="search" placeholder="Type to search ...">
        </div> -->
        <table width=100%>
            <thead>
                <tr>
                    <th><input type="checkbox" style="display:none;" id="checkAll">Chọn</th>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Xóa</th>
                    <th>Sửa</th>
                </tr>
            </thead>

            <?php
               $all_products = mysqli_query($db, "select * from products order by product_id ASC");

               $i = 1;
               while($row=mysqli_fetch_array($all_products)) {
                $images = explode(" ", $row['product_image']);
            ?>

            <tbody>
                <tr>
                    <td><input type="checkbox" name="deleteAll[]" value="<?php echo $row['product_id']; ?>"></td>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['product_title']; ?></td>
                    <td><?php echo $row['product_price']; ?></td>
                     <td> <img src="../images/product/<?php echo $images[0]; ?>" width="70" height="50" > </td>
                    
                    <td> <a href="manager.php?action=view_product&delete_product=<?php echo $row['product_id'];?>">Xóa</a> </td>
                    <td><a href="manager.php?action=edit_product&product_id=<?php echo $row['product_id'];?>">Sửa</a></td>
                </tr>
            </tbody>
            <?php  $i++; }  //End While loop?> 

            <tr>
                <td><input type="submit" name="delete_all" value="Xóa"></td>
            </tr>
        </table>


    </form>
</div>

<?php
// Delete Product -->
if (isset($_GET['delete_product'])) {
    $delete_product = mysqli_query($db, "delete from products where product_id = '$_GET[delete_product]' ");

    if ($delete_product) {
        echo "<script> alert('Sản phẩm đã được xóa thành công!') </script>";

        echo "<script> window.open('manager.php?action=view_product','_self') </script>";
    }
}

// Remove item selected using foreach loop

if (isset($_POST['deleteAll'])) {
    $remove = $_POST['deleteAll'];

    foreach ($remove as $key) {
        $run_remove = mysqli_query($db, "delete from products where product_id='$key'");

        if ($run_remove) {
            echo "<script> alert('Sản phẩm đã được xóa thành công!') </script>";

            echo "<script> window.open('manager.php?action=view_product','_self') </script>";
        }
        else {
            echo "<script> alert('Mysqli failed: mysqli_error($db)') </script>";
        }
        
    }
}


?>

