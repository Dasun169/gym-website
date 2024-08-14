<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "my_db");
if (!$con) {
    die("Not connected to the database : " . mysqli_error($con));
}

$username = $_SESSION['userName'];

$query = "SELECT * FROM payment WHERE userName = '$username'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<script>
            alert('Your payment is almost done');
            window.location.href = 'home.html';
          </script>";
} else {
    echo "<script>
            window.location.href = 'payment.html';
          </script>";
}

mysqli_close($con);
?>