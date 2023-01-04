<?php

if (isset($_POST['submit'])) {
  $user = $_POST['username'];
  $age = $_POST['age'];
  $degree = $_POST['degree'];

  setcookie('username', $user, time() + 86400);
  setcookie('age', $age, time() + 86400);
  setcookie('degree', $degree, time() + 86400);


  header('location: display.php');
}
