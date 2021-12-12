<?php
    include_once '../query/connect_to_server.php'
?>

<div class="view-product-box">
    <h2>Danh sách thành viên</h2>
    <div class="border-bottom"></div>

    <form action="" method="post" enctype="multipart/form-data">
        <!-- <div class="search-bar">
            <input type="text" id="search" placeholder="Type to search ...">
        </div> -->
        <table width=100%>
            <thead>
                <tr>
                    <th><input type="checkbox" style="display:none;" id="checkAll">Chọn</th>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Xóa</th>
                </tr>
            </thead>

            <?php
               $all_user = mysqli_query($db, "select * from user order by user_id ASC");

               $i = 1;
               while($row=mysqli_fetch_array($all_user)) {
            ?>

            <tbody>
                <tr>
                    <td><input type="checkbox" name="deleteAll[]" value="<?php echo $row['user_id']; ?>"></td>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phonenumber']; ?></td>
                    <td> <a href="manager.php?action=view_user&delete_user=<?php echo $row['user_id'];?>">Xóa</a> </td>

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
// Delete Account User -->
if (isset($_GET['delete_user'])) {
    $delete_user = mysqli_query($db, "delete from user where user_id = '$_GET[delete_user]' ");

    if ($delete_user) {
        echo "<script> alert('Người dùng đã được xóa thành công!') </script>";

        echo "<script> window.open('manager.php?action=view_user','_self') </script>";
    }
}

// Remove item selected using foreach loop

if (isset($_POST['deleteAll'])) {
    $remove = $_POST['deleteAll'];

    foreach ($remove as $key) {
        $run_remove = mysqli_query($db, "delete from user where user_id='$key'");

        if ($run_remove) {
            echo "<script> alert('Người dùng đã được xóa thành công!') </script>";

            echo "<script> window.open('manager.php?action=view_user','_self') </script>";
        }
        else {
            echo "<script> alert('Mysqli failed: mysqli_error($db)') </script>";
        }
        
    }
}


?>

