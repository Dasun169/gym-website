<?php

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die("Not connected to database: " . mysqli_error($con));
}

$sql_create_db = "CREATE DATABASE IF NOT EXISTS my_db";
if (!mysqli_query($con, $sql_create_db)) {
    die("Error creating database: " . mysqli_error($con));
}

mysqli_select_db($con, "my_db");

$sql1 = "CREATE TABLE IF NOT EXISTS user(
  fullName VARCHAR(40),
  userName VARCHAR(30) PRIMARY KEY,
  email VARCHAR(50),
  phoneNumber VARCHAR(15),
  password VARCHAR(255)
)";
if (!mysqli_query($con, $sql1)) {
    die("Error creating table: " . mysqli_error($con));
}

$fullName = mysqli_real_escape_string($con, $_POST['fullName']);
$userName = mysqli_real_escape_string($con, $_POST['userName']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql_check_user = "SELECT * FROM user WHERE userName = '$userName'";
$result = mysqli_query($con, $sql_check_user);

if (mysqli_num_rows($result) > 0) {
    echo "<script>
            alert('Username already taken!');
            window.history.back();
          </script>";
    exit(); 
}

$sql2 = "INSERT INTO user (fullName, userName, email, phoneNumber, password)
VALUES ('$fullName', '$userName', '$email', '$phoneNumber', '$hashedPassword')";

if (mysqli_query($con, $sql2)) {
    echo "<script>
            alert('Registration successful!');
            window.location.href = 'login.html';
          </script>";
    exit(); 
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);

?>
