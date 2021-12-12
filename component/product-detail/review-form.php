<?php
$user = $_SESSION['user'];
$user_info = get_user_name_avatar($user);
$invalid = false;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $product_id = intval($_GET['id']);
    $review = $_POST['quality'];
    $comment = $_POST['reviewContent'];
    $invalid = false;
    if(strlen($comment) == 0){
        $invalid = true; $errMsg = "Enter your review...";
    }
    if(!$invalid){
        add_new_comment($user, $product_id, $review, $comment);
        echo '<script>alert("Review successfully");
            </script>';
        header("Refresh:0");
    }
}
?>
<form class="review" method="post">
    <div class="review-avatar"><img src="images/<?php echo $user_info['avatar']; ?>" width="100%" /></div>
    <div class="review-name"><?php echo $user_info['name']; ?></div>
    <div class="review-content">
        <p><i>Quality:</i></p>
        <div class="review-quality">
            <div class="size-input">
                <input type="radio" id="quality-5" value="Rất tốt" name="quality" checked />
                <label for="quality-5"> Very Good </label>
            </div>
            <div class="size-input">
                <input type="radio" id="quality-4" value="Tốt" name="quality" />
                <label for="quality-4"> Good </label>
            </div>
            <div class="size-input">
                <input type="radio" id="quality-3" value="Tạm" name="quality" />
                <label for="quality-3"> Normal </label>
            </div>
            <div class="size-input">
                <input type="radio" id="quality-2" value="Tệ" name="quality" />
                <label for="quality-2"> Bad </label>
            </div>
            <div class="size-input">
                <input type="radio" id="quality-1" value="Rất tệ" name="quality" />
                <label for="quality-1"> Very Bad </label>
            </div>
        </div>

        <p><i>Content:</i></p>
        <textarea name="reviewContent" rows="5" placeholder="Write something ..."></textarea>
        <input type="submit" value="Send" />
        <div class="error_msg">
            <?php if ($invalid) echo $errMsg ?>
        </div>
    </div>
</form>