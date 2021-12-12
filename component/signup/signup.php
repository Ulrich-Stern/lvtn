<link rel="stylesheet" type="text/css" href="./component/login/login.css" />
<?php
    $invalid = false;
    $errMsg = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $repeatPwd = $_POST['repeatPassword'];

        if (strlen($name) <= 0) {
          $invalid = true; $errMsg = "Enter your name!";
        }
        else if (!preg_match("/[a-zA-Z ]+/", $name)) {
          $invalid = true; $errMsg = "Enter your name!";
        }
        if (!preg_match("/[a-zA-Z0-9\.]+/", $user)) {
            $invalid = true; $errMsg = "Username only contains letter and number";
        }
        if(username_checker($user) == -1){
            $invalid = true; $errMsg = "Username already existed.";
        }
        else if (!preg_match("/[a-zA-Z0-9\.]+@[a-zA-Z]+\.[a-zA-Z]+/", $email)) {
            $invalid = true; $errMsg = "Email is not valid.";
        }
        else if ($pwd != $repeatPwd){
            $invalid = true; $errMsg = "Password is not correct.";
        }

        if (!$invalid) {
            signup_new_account($name, $user, $email, $pwd);
            echo '<script>alert("Sign up successfully");      
                    window.location="login.php";
                  </script>';
        }
    }
?>
<div class="gradient-container">
    <div class="center">
      <h1>Sign up</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="txt_field">
          <input type="text" name="name" required>
          <span></span>
          <label>Name</label>
        </div>
        <div class="txt_field">
          <input type="text" name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="text" name="email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
          <input type="password" name="repeatPassword" required>
          <span></span>
          <label>Enter password again</label>
        </div>
        <input type="submit" value="Sign up">
        <div class="error_msg">
            <?php if ($invalid) echo $errMsg ?>
        </div>
        <div class="signup_link">
          Already have an acount? <a href="login.php">Log in</a>
        </div>
      </form>
    </div>
</div>