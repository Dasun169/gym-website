<?php

$con = mysqli_connect("localhost", "root", "", "my_db");
if (!$con) {
    die("Not connected to database: " . mysqli_error($con));
}

$userName = mysqli_real_escape_string($con, $_POST['userName']);
$email = mysqli_real_escape_string($con, $_POST['email']);

$sql_check_user = "SELECT * FROM user WHERE userName = '$userName' AND email = '$email'";
$result = mysqli_query($con, $sql_check_user);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('User not found! Please register first.');
            window.history.back();
          </script>";
    exit();
}

// Create payment table if it doesn't exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS payment(
  accType VARCHAR(10),
  userName VARCHAR(30),
  email VARCHAR(50),
  cardNo VARCHAR(16),
  expiryDate VARCHAR(5),
  PRIMARY KEY (cardNo)
)";
if (!mysqli_query($con, $sql_create_table)) {
    die("Error creating table: " . mysqli_error($con));
}

// Sanitize and get the POST data
$accType = mysqli_real_escape_string($con, $_POST['accType']);
$cardNo = mysqli_real_escape_string($con, $_POST['cardNo']);
$expiryDate = mysqli_real_escape_string($con, $_POST['expiryDate']);

// Insert the data into the payment table
$sql_insert = "INSERT INTO payment (accType, userName, email, cardNo, expiryDate)
               VALUES ('$accType', '$userName', '$email', '$cardNo', '$expiryDate')";

if (mysqli_query($con, $sql_insert)) {
    echo "<script>
            alert('Payment successful!');
            window.location.href = 'home.html';
          </script>";
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);

?>
