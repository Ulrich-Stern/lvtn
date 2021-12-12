<?php
    include_once '../query/connect_to_server.php';
    $edit_product = mysqli_query($db, "select * from products where product_id='$_GET[product_id]'");
    $fetch_edit = mysqli_fetch_array($edit_product);
    $product_img = explode(" ", $fetch_edit['product_image']);
?>

<div class="form-box">
    <form action="" method="post" enctype="multipart/form-data">

    <table align="center" width="100%">
        <tr >
            <td colspan="7">
                <h2>Sửa thông tin sản phẩm</h2>
                <div class="border-bottom"></div>
            </td>
        </tr>
        <tr>
            <td><b>Tên sản phẩm:</b></td>
            <td><input type="text" name="product-title" value ="<?php echo $fetch_edit['product_title']; ?>" size="60" required></td>
        </tr>

        <tr>
            <td><b>Danh mục</b></td>
            <td>
                <select name="product_cate">
                    <option>Chọn 1 danh mục</option>
                    <?php
                        $get_cate = "select * from category";
                        $run_cate = mysqli_query($db, $get_cate);
                        while($row_cate = mysqli_fetch_array($run_cate)) {
                            $cate_id = $row_cate['cate_id'];
                            $cate_title = $row_cate['cate_title'];

                        // get category of selected item
                        if ($fetch_edit['product_category'] == $cate_id) {
                            echo "<option value='$fetch_edit[product_category]' selected>$cate_title</option>";
                        }
                        else {
                            echo "<option value='$cate_id'>$cate_title</option>";
                        }
                        }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td valign=top><b>Ảnh sản phẩm: </b> </td>
            <td>
                <input type="file" name="product_image">
                <div class="edit_image">
    
                    <img src="../images/product/<?php echo $product_img[0]; ?>" width ="100" height = "70">
                </div>
            </td>
        </tr>

        <tr>
            <td><b>Giá: </b> </td>
            <td><input type="text" name="product-price"  value="<?php echo $fetch_edit['product_price']; ?>" required></td>
        </tr>

        <tr>
            <td valign="top"><b>Mô tả sản phẩm:</b></td>
            <td><textarea name="product-desc" rows="10"><?php echo $fetch_edit['product_desc']; ?> </textarea></td>
        </tr>

        <tr align="center">
            <td colspan="7"><input type="submit" name="edit-product" value="Save"> </td>
        </tr>
    </table>
    </form>

</div>

<?php
    if (isset($_POST['edit-product'])) {
            $product_title = trim(mysqli_real_escape_string($db,$_POST['product-title'])) ;
            $product_cate = $_POST['product_cate'];
            $product_price = $_POST['product-price'];
            $product_desc = trim(mysqli_real_escape_string($db,$_POST['product-desc'])) ;
            
            // get image
            $product_image = $_FILES['product_image']['name'];
            $product_image_tmp = $_FILES['product_image']['tmp_name'];
    
            if (!empty($_FILES['product_image']['name'])) {
                if (move_uploaded_file($product_image_tmp, "../images/product/$product_image")) {
                    $update_product = mysqli_query($db, "update products set product_category = '$product_cate', product_title = '$product_title', product_price = '$product_price', product_desc = '$product_desc', product_image = '$product_image' where product_id = '$_GET[product_id]'");
                }
            }
            else {
                    $update_product = mysqli_query($db, "update products set product_category = '$product_cate', product_title = '$product_title', product_price = '$product_price', product_desc = '$product_desc'  where product_id = '$_GET[product_id]'");
            }
            if ($update_product) {
                echo "<script> alert('Sản phẩm được cập nhật thành công') </script>";
                echo "<script>window.open(window.location.href,'_self')</script>";
            } 
           
        } 
?>