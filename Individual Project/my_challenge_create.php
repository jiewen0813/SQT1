<?php
session_start();
include'config.php';

// Check if the user is logged in
if(isset($_SESSION["SID"])) {
    $studentID = $_SESSION["SID"];
} else {
    // Redirect to the login page if the user is not logged in
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
<title>My Study KPI</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
<script>
//for responsive sandwich menu
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
</head>
<body>
<div class="header">
</div>

<?php include 'menu.php';?>

<div class="userAuth">
        <?php 
        //login&logout section
        if(isset($_SESSION["SID"])){
            echo '<b> '. $_SESSION["userName"] . '</b> <a href="logout.php">| Logout |</a> &nbsp;&nbsp;&nbsp; <br>';        
        }            
        else {
            echo '<a href="login.php">| Login |</a> &nbsp;&nbsp;&nbsp; <br>';
        }
        ?>
    </div>
<h1>My Challenge</h1>
<h2>Add Challenge and Plan</h2>
<p align="center">Required field with mark*</p>
<div style="padding:0 10px;" id="challengeDiv">
   <form method="POST" action="my_challenge_action.php" enctype="multipart/form-data" id="myForm">
    <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">

<table border="1" id="myTable">
<tr>
<td>Semester*</td>
<td width="1px">:</td>
<td>
<select size="1" name="sem" required>
<option value="">&nbsp;</option>
<option value="1">1</option>;
<option value="2">2</option>;
</select>
</td>
</tr>
<tr>
<td>Year*</td>
<td>:</td>
<td>
<input type="text" name="year" size="8" required placeholder="YYYY/YYYY">
</td>
</tr>
<tr>
<td>Challenge*</td>
<td>:</td>
<td>
<textarea rows="4" name="challenge" cols="20" required></textarea>
</td>
</tr>
<tr>
<td>Plan*</td>
<td>:</td>
<td>
<textarea rows="4" name="plan" cols="20" required></textarea>
</td>
</tr>
<tr>
<td>Remark</td>
<td>:</td>
<td>
<textarea rows="4" name="remark" cols="20"></textarea>
</td>
</tr>
<tr>
<td>Upload photo</td>
<td>:</td>
<td>
Max size: 488.28KB<br>
<input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
</td>
</tr>
<tr>
<td colspan="3" align="right">
<input type="submit" value="Submit" name="B1">
<input type="reset" value="Reset" name="B2">
</td>
</tr>
</table>
</form>
</div>
<p></p>
<footer>
	<small><i>Copyright &copy; 2023 - Leong Jie Wen</i></small>
	</footer>


</body>
</html>
