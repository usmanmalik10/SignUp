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

  $email = mysqli_real_escape_string($con, $_POST['email']);


  $emailquery = "select * from registration where email = '$email' ";

  $query = mysqli_query($con, $emailquery);

  $emailcount = mysqli_num_rows($query);

  if ($emailcount > 0) {

    $userdata = mysqli_fetch_array($query);

    $username = $userdata['username'];
    $token = $userdata['token'];

    $subject = "Password Reset";
    $body = "Hi, $username.  Click here to reset your password http://localhost/php/crud/SignUp/reset_password.php?token=$token";
    $sender_email = "From: usmanmaliksahib2611@gmail.com";

    if (mail($email, $subject, $body, $sender_email)) {
      $_SESSION['msg'] = "check your email to reset your password $email";
      header('location: login.php');
    } else {
      echo "Email sending failed...";
    }
  } else {
    echo "No email found";
  }
}




?>

<body>
  <div class="card bg-light">
    <article class="card-body mx-auto" style="max-width: 400px;">
      <h4 class="card-title mt-3 text-center">Recover Your Account</h4>
      <p class="text-center">Please Fill Existing Email </p>

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


        <!-- Form-group 2 -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-envelope"></i> </span>
          </div>
          <input type="email" class="form-control" name="email" placeholder="Email address" required>
        </div>



        <!-- Form-group 6 -->
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-primary btn-block">Send Mail</button>
        </div>
        <!-- Form-group  -->
        <p class="text-center">Have an account? <a href="login.php">Log In</a></p>
      </form>
    </article>
  </div>
  <!--card.//  -->
</body>

</html>