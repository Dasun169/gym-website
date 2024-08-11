<?php

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die("Not connected to database: " . mysqli_error($con));
}

mysqli_select_db($con, "my_db");

// Create the contact_me table if it doesn't exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS contact_me(
  username VARCHAR(30),
  email VARCHAR(50),
  subject VARCHAR(100),
  message TEXT
)";
if (!mysqli_query($con, $sql_create_table)) {
    die("Error creating table: " . mysqli_error($con));
}

// Get the form data
$username = mysqli_real_escape_string($con, $_POST['username']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$subject = mysqli_real_escape_string($con, $_POST['subject']);
$message = mysqli_real_escape_string($con, $_POST['message']);

// Check if the username and email exist in the user table
$sql_check_user = "SELECT * FROM user WHERE username = '$username' AND email = '$email'";
$result = mysqli_query($con, $sql_check_user);
if (mysqli_num_rows($result) > 0) {
    // Insert the data into the contact_me table
    $sql_insert = "INSERT INTO contact_me (username, email, subject, message)
                   VALUES ('$username', '$email', '$subject', '$message')";
    if (mysqli_query($con, $sql_insert)) {
        echo "<script>
                alert('Message sent successfully!');
                window.location.href = 'contact-us.html';
              </script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "<script>
            alert('Please register first!');
            window.location.href = 'register.html';
          </script>";
}

mysqli_close($con);
?>