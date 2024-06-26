<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Action</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" type="text/css" href="mystyle.css" media="screen" />
</head>
<body>
<h2>Login Information</h2>
<?php
// Get login values from login form
$userEmail = $_POST['userEmail']; 
$userPwd = $_POST['userPwd'];

// Prepare the SQL statement with a placeholder
$sql = "SELECT * FROM user WHERE userEmail = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail); // "s" indicates the type of the parameter (string)
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Check password hash
    $row = $result->fetch_assoc();
    if (password_verify($userPwd, $row['userPwd'])) {
        // Set session variables
        $_SESSION["SID"] = $row["studentID"];
        $_SESSION["userName"] = $row["userName"];
        // Set logged-in time
        $_SESSION['loggedin_time'] = time();

        // Display a JavaScript toast notification
        echo '<script type="text/javascript">
            alert("Login successful! Welcome, ' . htmlspecialchars($row["userName"]) . '");
            window.location.href = "profile.php";
        </script>';
        exit(); // Make sure to exit after the alert
    } else {
        // Handle incorrect password
        echo 'Login error, user email and password are incorrect.<br>';
        echo '<a href="login.php"> | Login |</a> &nbsp;&nbsp;&nbsp; <br>';
    }
} else {
    // Handle user not found
    echo "Login error, user does not exist. <br>";
    echo '<a href="register.php"> | Register |</a>&nbsp;&nbsp;&nbsp; <br>';
}

$stmt->close();
mysqli_close($conn);
?>
</body>
</html>
