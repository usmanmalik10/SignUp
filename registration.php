<?php

session_start();
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


<?php

include 'dbcon.php';

if (isset($_POST["submit"])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

  $pass = password_hash($password, PASSWORD_BCRYPT);
  $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

  $token = bin2hex(random_bytes(15));

  $emailquery = "select * from registration where email = '$email' ";

  $query = mysqli_query($con, $emailquery);

  $emailcount = mysqli_num_rows($query);

  if ($emailcount > 0) {
    echo "email already exist";
  } else {
    if ($password === $cpassword) {
      $insertquery = "insert into registration (username, email, mobile, password, cpassword, token, status) values('$username','$email','$mobile','$pass','$cpass', '$token', 'inactive')";

      $iquery = mysqli_query($con, $insertquery);

      if ($iquery) {

        $subject = "Email Activation";
        $body = "Hi, $username.  Click here to activate you account http://localhost/php/crud/SignUp/activate.php?token=$token";
        $sender_email = "From: usmanmaliksahib2611@gmail.com";

        if (mail($email, $subject, $body, $sender_email)) {
          $_SESSION['msg'] = "check your email to activate your account $email";
          header('location: login.php');
        } else {
          echo "Email sending failed...";
        }
      } else {
?>
        <script>
          alert("No Connection");
        </script>
      <?php
      }
    } else {
      ?>
      <script>
        alert("Password not Matching");
      </script>
<?php
    }
  }
}




?>

<body>
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
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Form-group 1 -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-user"></i> </span>
          </div>
          <input type="text" class="form-control" name="username" placeholder="Full name" required>
        </div>
        <!-- Form-group 2 -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-envelope"></i> </span>
          </div>
          <input type="email" class="form-control" name="email" placeholder="Email address" required>
        </div>
        <!-- Form-group 3 -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-phone"></i> </span>
          </div>
          <input type="number" class="form-control" name="mobile" placeholder="Phone number" required>
        </div>
        <!-- Form-group 4 -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i> </span>
          </div>
          <input type="password" class="form-control" name="password" placeholder="Create password" value="" required>
        </div>
        <!-- Form-group  5-->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i> </span>
          </div>
          <input type="password" class="form-control" name="cpassword" placeholder="Repeat password" required>
        </div>
        <!-- Form-group 6 -->
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-primary btn-block">Create Account</button>
        </div>
        <!-- Form-group  -->
        <p class="text-center">Have an account? <a href="login.php">Log In</a></p>
      </form>
    </article>
  </div>
  <!--card.//  -->
</body>

</html>