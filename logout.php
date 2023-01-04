<?php

session_start();
session_destroy();

setcookie('emailcookie', $email, time() - 86400);
setcookie('passwordcookie', $password, time() - 86400);

header('location:login.php');
