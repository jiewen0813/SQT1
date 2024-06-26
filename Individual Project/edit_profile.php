<?php
session_start();
include'config.php';

// Check if the user is logged in
if(isset($_SESSION["SID"])) {
    $studentID = $_SESSION["SID"];
    
    // Fetch user-specific information from the database
    $query = "SELECT * FROM user WHERE studentID = '$studentID'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
		$userName = $row["userName"];
		$userEmail = $row["userEmail"];
		$phoneNo = $row["phoneNo"];
		$program = $row["program"];
		$intakeBatch = $row["intakeBatch"];
		$mentorName = $row["mentorName"];
		$address = $row["address"];
		$state = $row["state"];
		$studyMotto = $row["studyMotto"];
		$imgpath = $row["imgpath"];  // Corrected line
    } else {
        // Handle the case where the user is not found in the database
        echo "User not found in the database.";
        exit();
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        function resetForm() {
            document.getElementById("myForm").reset();
        }

        function clearForm() {
            var elements = document.getElementById("myForm").elements;

            for (var i = 0; i < elements.length; i++) {
                if (elements[i].type != "button" && elements[i].type != "reset") {
                    elements[i].value = "";
                }
            }
        }
    </script>
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <div class="header"></div>

    <?php include'menu.php'; ?>

    <div class="userAuth">
        <?php 
        // Login & logout section
        if(isset($_SESSION["SID"])) {
            echo '<b> '. $_SESSION["userName"] . '</b> <a href="logout.php">| Logout |</a> &nbsp;&nbsp;&nbsp; <br>';
        } else {
            echo '<a href="index.php?login=1">| Login |</a> &nbsp;&nbsp;&nbsp; <br>';
        }
        ?>
    </div>
<div style="padding:0 10px;" id="challengeDiv">
    <h1>Edit Profile</h1>

    <form method="POST" action="edit_profile_action.php" id="myForm" enctype="multipart/form-data">

        <table border="1" id="myTable">
            <tr>
                <td>Name*</td>
				<td>:</td>
                <td>
                    <input type="text" name="userName" size="15" value="<?= $userName ?>" required>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>
                    <input type="text" name="userEmail" size="30" value="<?= $userEmail ?>" required>
                </td>
            </tr>
			<tr>
                <td>Phone No</td>
                <td>:</td>
                <td>
                    <input type="text" name="phoneNo" size="30" value="<?= $phoneNo ?>" required>
                </td>
            </tr>
            <tr>
                <td>Program*</td>
                <td>:</td>
                <td>
                    <input type="text" name="program" size="30" value="<?= $program ?>" required>
                </td>
            </tr>
			<tr>
                <td>Intake Batch*</td>
                <td>:</td>
                <td>
                    <input type="text" name="intakeBatch" size="30" value="<?= $intakeBatch ?>" required placeholder="YYYY/YYYY">
                </td>
            </tr>
            <tr>
                <td>Mentor Name</td>
                <td>:</td>
                <td>
                    <input type="text" name="mentorName" size="30" value="<?= $mentorName ?>">
                </td>
            </tr>
			<tr>
                <td>Address</td>
                <td>:</td>
                <td>
                    <textarea rows="4" name="address" cols="30"><?= $address ?></textarea>
                </td>
            </tr>
			<tr>
                <td>State</td>
                <td>:</td>
                <td>
                    <input type="text" name="state" size="30" value="<?= $state ?>">
                </td>
            </tr>
            <tr>
                <td>Study Motto</td>
                <td>:</td>
                <td>
                    <textarea rows="4" name="studyMotto" cols="30"><?= $studyMotto ?></textarea>
                </td>
            </tr>
			<tr>
                <td>Current Photo</td>
                <td>:</td>
                <td>
                    <?php
                    if (!empty($imgpath)) {
                        echo $imgpath;
                    } else {
                        echo 'No photo available';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Upload New Photo</td>
                <td>:</td>
                <td>
                    Max size: 488.28KB<br>
                    <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="right">
                    <input type="submit" value="Submit" name="B1">
                    <input type="reset" value="Reset" name="B2" onclick="resetForm()">
                    <input type="button" value="Clear" name="B3" onclick="clearForm()">
                </td>
            </tr>
        </table>
    </form>
</div>
    <footer>
        <small><i>Copyright &copy; 2023 - Leong Jie Wen</i></small>
    </footer>
</body>
</html>
