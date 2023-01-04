<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "signup";

$con = mysqli_connect($server, $user, $password, $db);

if ($con) {
  echo "Connection SUccessful";
} else {
?>
<script>
alert("No Connection");
</script>
<?php
}
?>