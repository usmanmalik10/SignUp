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


<?php

include 'dbcon.php';

if (isset($_POST["submit"])) {

  if (isset($_GET['token'])) {

    $token = $_GET['token'];


    $newpassword = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $pass = password_hash($newpassword, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);


    if ($newpassword === $cpassword) {

      $updatequery = " update registration set password = '$pass' where token = '$token' ";



      $iquery = mysqli_query($con, $updatequery);

      if ($iquery) {

        $_SESSION['msg'] = "Your password has been updated";
        header('location: login.php');
      } else {
        $_SESSION['passmsg'] = "Your password is not updated";
        header('location: reset_password.php');
      }
    } else {
      $_SESSION['msg'] = "Password are not matching";
      // echo "Password are not matching";
    }
  } else {
    echo "No Token Found";
  }
}


?>

<body>
  <div class="card bg-light">
    <article class="card-body mx-auto" style="max-width: 400px;">
      <h4 class="card-title mt-3 text-center">New Password</h4>
      <p class="text-center">Get started with you free account</p>

      <p class="bg-info text-white px-5">
        <?php
        if (isset($_SESSION['passmsg'])) {
          echo $_SESSION['passmsg'];
        } else {
          echo $_SESSION['passmsg'] = "";
        }
        ?>
      </p>





      <form method="POST" action="">


        <!-- Form-group 4 -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i> </span>
          </div>
          <input type="password" class="form-control" name="password" placeholder="New password" value="" required>
        </div>
        <!-- Form-group  5-->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i> </span>
          </div>
          <input type="password" class="form-control" name="cpassword" placeholder="Confirn password" required>
        </div>
        <!-- Form-group 6 -->
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-primary btn-block">Update Password</button>
        </div>
        <!-- Form-group  -->
        <p class="text-center">Have an account? <a href="login.php">Log In</a></p>
      </form>
    </article>
  </div>
  <!--card.//  -->
</body>

</html>