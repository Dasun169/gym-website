<?php

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die("Not connected to database: " . mysqli_error($con));
}

mysqli_select_db($con, "my_db");

$userName = mysqli_real_escape_string($con, $_POST['userName']);
$password = mysqli_real_escape_string($con, $_POST['password']);

$sql = "SELECT * FROM user WHERE userName = '$userName'";
$result = mysqli_query($con, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['password'])) {
            echo "<script>
                    alert('Login successful!');
                    window.location.href = 'packages.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Invalid password!');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('User not found!');
                window.location.href = 'home.html';
              </script>";
    }
} else {
    echo "<script>
            alert('Register your account first!');
            window.location.href = 'register.html';
          </script>";
}

mysqli_close($con1);

?>