<?php

session_start();
ob_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php
  include 'css/style.php';
  include 'links/links.php';
  ?>
</head>

<body>

  <?php
  include 'dbcon.php';

  if (isset($_POST["submit"])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_search = " select * from registration where email='$email' and status= 'active' ";
    $query = mysqli_query($con, $email_search);

    $email_count = mysqli_num_rows($query);

    if ($email_count) {

      $email_pass = mysqli_fetch_assoc($query);

      $db_pass = $email_pass['password'];


      // For use any value to any where 
      $_SESSION['username'] = $email_pass['username'];

      $pass_decode = password_verify($password, $db_pass);

      if ($pass_decode) {
        if (isset($_POST['rememberme'])) {

          setcookie('emailcookie', $email, time() + 86400);
          setcookie('passwordcookie', $password, time() + 86400);


          header('location: ../Portfolio/index.php');
        } else {

          header('location: ../Portfolio/index.php');
        }
      } else {
        echo "password incorrect";
      }
    } else {
      echo "Invalid Email";
    }
  }





  ?>





  <div class="card bg-light">
    <article class="card-body mx-auto" style="max-width: 400px;">
      <h4 class="card-title mt-3 text-center">Create Account</h4>
      <p class="text-center">Get started with you free account</p>
      <p>
        <a href="" class="btn btn-block btn-gmail"><i class="fa-brands fa-google"></i>Login via Gmail</a>
        <a href="" class="btn btn-block btn-facebook"><i class="fa-brands fa-square-facebook"></i>Login via facebook</a>
      </p>
      <p class="divider-text">
        <span class="bg-light">OR</span>
      </p>
      <div>
        <p class="bg-success text-white px-4">
          <?php

          if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
          } else {
            echo $_SESSION['msg'] = "You are logged Out. Please login agian.";
          }

          ?></p>
      </div>
      <form method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>">

        <!-- Form-group 1 -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-envelope"></i> </span>
          </div>
          <input type="email" class="form-control" name="email" placeholder="Email address" value="
          <?php
          if (isset($_COOKIE['emailcookie'])) {
            echo $_COOKIE['emailcookie'];
          }
          ?>" required>
        </div>
        <!-- Form-group 2 -->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i> </span>
          </div>
          <input type="password" class="form-control" name="password" placeholder="Enter password" value="
          <?php
          if (isset($_COOKIE['passwordcookie'])) {
            echo $_COOKIE['passwordcookie'];
          }
          ?>" required>
        </div>

        <!-- Form-group 2 -->
        <div class="form-group">
          <input type="checkbox" name="rememberme"> Remember Me
        </div>


        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
        </div>
        <!-- Form-group  -->
        <p class="text-center">Forgot Your Password No Worry? <a href="recover_email.php"> Click Here </a></p>
        <p class="text-center">Not have an account? <a href="registration.php">SignUp Here </a></p>
      </form>
    </article>
  </div>
  <!--card.//  -->
</body>

</html>