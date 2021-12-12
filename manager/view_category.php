<?php
    include_once '../query/connect_to_server.php'
?>

<div class="view-product-box">
    <h2>Xem danh mục</h2>
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
                    <th>Tên danh mục</th>
                    <th>Xóa</th>
                    <th>Sửa</th>
                </tr>
            </thead>

            <?php
               $all_cate = mysqli_query($db, "select * from category order by cate_id ASC");

               $i = 1;
               while($row=mysqli_fetch_array($all_cate)) {
            ?>

            <tbody>
                <tr>
                    <td><input type="checkbox" name="deleteAll[]" value="<?php echo $row['cate_id']; ?>"></td>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['cate_title']; ?></td>

                    <td> <a href="manager.php?action=view_cate&delete_cate=<?php echo $row['cate_id'];?>">Xóa</a> </td>
                    <td><a href="manager.php?action=edit_cate&cate_id=<?php echo $row['cate_id'];?>">Sửa</a></td>
                </tr>
            </tbody>
            <?php $i++; }  //End While loop?> 

            <tr>
                <td><input type="submit" name="delete_all" value="Xóa"></td>
            </tr>
        </table>


    </form>
</div>

<?php
// Delete Product -->
if (isset($_GET['delete_cate'])) {
    $delete_cate = mysqli_query($db, "delete from category where cate_id = '$_GET[delete_cate]' ");

    if ($delete_cate) {
        echo "<script> alert('Danh mục đã được xóa thành công!') </script>";

        echo "<script> window.open('manager.php?action=view_cate','_self') </script>";
    }
}

// Remove item selected using foreach loop

if (isset($_POST['deleteAll'])) {
    $remove = $_POST['deleteAll'];

    foreach ($remove as $key) {
        $run_remove = mysqli_query($db, "delete from category where cate_id='$key'");

        if ($run_remove) {
            echo "<script> alert('Danh mục đã được xóa thành công!') </script>";

            echo "<script> window.open('manager.php?action=view_cate','_self') </script>";
        }
        else {
            echo "<script> alert('Mysqli failed: mysqli_error($db)') </script>";
        }
        
    }
}


?>

