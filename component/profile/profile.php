<link rel="stylesheet" type="text/css" href="./component/profile/profile.css" />
<?php
    $user = $_SESSION['user'];
    $user_info = get_user_profile($user);
    $user_carts = get_user_paid_cart($user);
    $invalid = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['update_profile'])){
            $name = $_POST['fullname'];
            $addr = $_POST['address'];
            $pnumber = $_POST['phone'];
            $gender = $_POST['gender'];
            $avatar = $_POST['avatar'];
            $invalid = false;
            if (strlen($name) <= 0) {
                $invalid = true; $errMsg = "Enter your name!";
            }
            else if (!preg_match("/[a-zA-Z ]+/", $name)) {
                $invalid = true; $errMsg = "Enter your name!";
            }
            if (!preg_match("/[a-zA-Z0-9\.]+/", $addr)) {
                $invalid = true; $errMsg = "Address not valid.";
            }
            else if (!preg_match('/^[0-9]+$/', $pnumber) || strlen($pnumber) < 10 || strlen($pnumber) > 11) {
                $invalid = true; $errMsg = "Phone number not valid.";
            }
            if(!$invalid){
                update_profile($user, $name, $addr, $pnumber, $avatar, $gender);
                echo '<script>alert("Update successfully");
                    </script>';
                header("Refresh:0");
            }
        }
        else if (isset($_POST['update_pwd'])){
            $oldPwd = $_POST['oldpwd'];
            $newPwd = $_POST['newpwd'];
            $repeatNewPwd = $_POST['repeatNewpwd'];
            $invalid = false;
            if(strlen($oldPwd) <= 0){
                $invalid = true; $errMsg = "Enter old password!";
            }
            else if (password_checker($user, $oldPwd) == 0){
                $invalid = true; $errMsg = "Old password not correct!";
            }
    
            if(strlen($newPwd) <= 0){
                $invalid = true; $errMsg = "Enter new password!";
            }
            else if($newPwd != $repeatNewPwd) {
                $invalid = true; $errMsg = "Incorrect";
            }
    
            if(!$invalid){
                update_password($user, $newPwd);
                echo '<script>alert("Update successfully. Please login!");
                        window.location="login.php";
                      </script>';
            }
        }
    }
    
?>
<div class="profile-container">
    <div class="profile-col-1">
        <img class="profile-avatar" src="images/<?php if($user_info['avatar'] != null) echo $user_info['avatar']; else echo "user-icon.png"; ?>" width="60%" />
        <div class="profile-username"><?php echo $user_info['name'];?></div>
        <div class="profile-email"><?php echo $user_info['email'];?></div>
        <div class="tab">
            <button class="tablinks active" onclick="switchProfileTab(0)">Change information</button>
            <button class="tablinks" onclick="switchProfileTab(1)">Change password</button>
            <button class="tablinks" onclick="switchProfileTab(2)">Order</button>
            <a href="logout.php"><button class="logout-tab">Log out</button></a>
        </div>
    </div>
    <div class="profile-col-2">
        <div class="tab-content active">
            <div class="tab-name">Change information</div>
            <form method="post">
                <label>Username:</label>
                <input type="text" value="<?php echo $user_info['name'];?>" id="fullname" name="fullname" />
                <label>Address:</label>
                <input type="text" value="<?php echo $user_info['address'];?>" id="address" name="address" />
                <label>Phone number:</label>
                <input type="text" value="<?php echo $user_info['phonenumber'];?>" id="phone" name="phone" />
                <label>Gender:</label><br />
                <div class="radio-group">
                    <input type="radio" value="Nam" id="male" name="gender" checked/>
                    <span class="checkmark"></span>
                    <label for="male">Male</label>
                </div>
                <div class="radio-group">
                    <input type="radio" value="Nữ" id="female" name="gender"/>
                    <span class="checkmark"></span>
                    <label for="female">Female</label>
                </div><br />
                <label>Avatar:</label>
                <input type="file" name="avatar" />
                <input type="submit" name="update_profile" value="Save" class="submit-btn" />
            </form>
            <div class="error_msg">
                <?php if ($invalid) echo $errMsg ?>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-name">Change password</div>
            <form method="post">
                <label>Old password:</label>
                <input type="password" name="oldpwd" />
                <label>New password:</label>
                <input type="password" name="newpwd" />
                <label>Enter new password again:</label>
                <input type="password" name="repeatNewpwd" />
                <input type="submit" name="update_pwd" value="Change Password" class="submit-btn" />
                </form>
        </div>
        <div class="tab-content">
            <div class="tab-name">Order</div>
            <table>
                <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th width="50%">name</th>
                        <th width="20%">Price</th>
                        <th width="20%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user_carts as $cart) :?>
                    <tr>
                        <td><?php echo $cart['product_id'];?></td>
                        <td><?php echo $cart['product_title'] . " x " . $cart['quantity'];?></td>
                        <td class="total-price"><?php echo $cart['total_price'];?></td>
                        <td>Transporting</td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    function switchProfileTab(tabidx) {
        var tabs = document.getElementsByClassName('tablinks');
        for (let tab of tabs) {
            tab.classList.remove('active');
        }
        var tabcontents = document.getElementsByClassName('tab-content');
        for (let tab of tabcontents) {
            tab.classList.remove('active');
        }
        tabs[tabidx].classList.add('active');
        tabcontents[tabidx].classList.add('active');
        window.scrollTo({
            top: 170,
            behavior: 'smooth'
        });
    }
    formatTotalPrice();
    function formatTotalPrice(){
        var prices = document.getElementsByClassName('total-price');
        for (price of prices) {
            if (!isNaN(Number(price.innerHTML))){
                price.innerHTML = Number(price.innerHTML).toLocaleString("vi-VN", {
                    style: 'currency', currency: 'VND'
                });
                price.style.color = 'red';
            }
        }
    }
</script>