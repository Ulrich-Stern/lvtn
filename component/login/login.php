<link rel="stylesheet" type="text/css" href="./component/login/login.css" />
<?php 
    $invalid = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $user = $_POST['username'];
        $pwd = $_POST['password'];
        if(!isset($_SESSION)) session_start(); 
        if ($user == 'admin' && $pwd == 'admin'){
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'admin';
        }
        else if (username_login_checker($user, $pwd) == 1){
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'member';
        }
        else {
            $invalid = true;
            session_destroy();
        }
        if (!$invalid) header("Location: index.php");
    }
?>
<div class="gradient-container">
    <div class="center">
      <h1>Log in</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="txt_field">
          <input type="text" name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">Forget password</div>
        <input type="submit" value="Log in">
        <div class="error_msg">
            <?php if ($invalid) echo "Login information not correct" ?>
        </div>
        <div class="signup_link">
          Don't have an account yet? <a href="signup.php">Sign up</a>
        </div>
      </form>
    </div>
</div>