<?php
    include_once '../query/connect_to_server.php';
    $edit_cate = mysqli_query($db, "select * from category where cate_id='$_GET[cate_id]'");

    $fetch_cate = mysqli_fetch_array($edit_cate);
?>


<div class="form-box">
    <form action="" method="post" enctype="multipart/form-data">

    <table align="center" width="100%">
        <tr >
            <td colspan="7">
                <h2>Sửa danh mục</h2>
                <div class="border-bottom"></div>
            </td>
        </tr>
        <tr>
            <td><b>Sửa tên</b></td>
            <td><input type="text" name="product-cate" value="<?php echo $fetch_cate['cate_title']; ?>" size="60" required></td>
        </tr>

        

        <tr align="center">
            <td colspan="7"><input type="submit" name="edit-cate" value="Lưu"> </td>
        </tr>
    </table>
    </form>

</div>


<?php
    if (isset($_POST['edit-cate'])) {
        $cate_title = mysqli_real_escape_string($db, $_POST['product-cate']);
        $edit_cate = mysqli_query($db, "update category set cate_title = '$cate_title' where cate_id = '$_GET[cate_id]'");
        if ($edit_cate) {
            echo "<script> alert('Danh muc được cập nhật thành công') </script>";
            echo "<script> window.open(window.location.href,'_self')</script> ";
        }
    }
?>