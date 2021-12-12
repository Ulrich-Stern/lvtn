<?php
    include_once '../query/connect_to_server.php'
?>

<div class="form-box">
    <form action="" method="post" enctype="multipart/form-data">

    <table align="center" width="100%">
        <tr >
            <td colspan="7">
                <h2>Thêm danh mục mới</h2>
                <div class="border-bottom"></div>
            </td>
        </tr>
        <tr>
            <td><b>Tên danh mục</b></td>
            <td><input type="text" name="product_cate" size="60" required></td>
        </tr>

        

        <tr align="center">
            <td colspan="7"><input type="submit" name="insert-cate" value="Thêm"> </td>
        </tr>
    </table>
    </form>

</div>


<?php
    if(isset($_POST['insert-cate'])) {
        $product_cate = mysqli_real_escape_string($db,$_POST['product_cate']);

        $insert_cate = mysqli_query($db, "insert into category (cate_title) values ('$product_cate')");

        if ($insert_cate) {
            echo "<script> alert('Thêm danh mục thành công') </script>";
            echo "<script>window.open(window.location.href,'_self')</script>";
        }
    }
?>