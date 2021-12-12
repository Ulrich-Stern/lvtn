<?php
    include_once '../query/connect_to_server.php'
?>

<div class="form-box">
    <form action="" method="post" enctype="multipart/form-data">

    <table align="center" width="100%">
        <tr >
            <td colspan="7">
                <h2>Thêm sản phẩm mới</h2>
                <div class="border-bottom"></div>
            </td>
        </tr>
        <tr>
            <td><b>Tên sản phẩm:</b></td>
            <td><input type="text" name="product-title" size="60" required></td>
        </tr>

        <tr>
            <td><b>Danh mục</b></td>
            <td>
                <select name="product-cate">
                    <option>Chọn 1 danh mục</option>
                    <?php
                        // code BE to get all categories
                        $get_cate = "select * from category";
                        $run_cate = mysqli_query($db, $get_cate);
                        while($row_cate = mysqli_fetch_array($run_cate)) {
                            $cate_id = $row_cate['cate_id'];
                            $cate_title = $row_cate['cate_title'];
                            echo "<option value='$cate_id'>$cate_title</option>";
                        }
                        
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td><b>Ảnh sản phẩm: </b> </td>
            <td><input type="file" name="product-image"></td>
        </tr>

        <tr>
            <td><b>Giá: </b> </td>
            <td><input type="text" name="product-price" required></td>
        </tr>

        <tr>
            <td valign="top"><b>Mô tả sản phẩm:</b></td>
            <td><textarea name="product-desc" rows="10"></textarea></td>
        </tr>

        <tr align="center">
            <td colspan="7"><input type="submit" name="insert-product" value="Thêm"> </td>
        </tr>
    </table>
    </form>

</div>


<?php
    if (isset($_POST['insert-product'])) {
        $product_title = $_POST['product-title'];
        $product_cate = $_POST['product-cate'];
        $product_price = $_POST['product-price'];
        $product_desc = trim(mysqli_real_escape_string($db,$_POST['product-desc'])) ;
        
        // get image
        $product_image = $_FILES['product-image']['name'];
        $product_image_tmp = $_FILES['product-image']['tmp_name'];
        move_uploaded_file($product_image_tmp, "../images/product/$product_image"); //

        $insert_product = "insert into products (product_category, product_title, product_price, product_image, product_desc) values('$product_cate','$product_title', '$product_price', '$product_image' ,'$product_desc')";


        $insert_pro = mysqli_query($db, $insert_product);

        if ($insert_pro) {
            echo "<script> alert('Thêm sản phẩm thành công') </script>";

            // echo "<script>window.open('manager.php?insert_product','_self') </script>";
        }
    }
?>