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
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
	<title>My Study KPI</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
<script>
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
	<div class="header"></div>
	
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
	<h1>Insert KPI Indicator</h1>
	<p align="center">Required field with mark*</p>
	<div style="padding:0 10px;" id="challengeDiv">
	<form method="POST" action="my_kpi_create_action.php" enctype="multipart/form-data" id="myForm">
    <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">

<table border="1" id="myTable">
<tr>
<td><b>Student's Aims/Semester*</b></td>
<td width="1px">:</td>
<td>
<select size="1" name="userChoice">
<option value="">&nbsp;</option>
<option value="Students Aim">Students Aim</option>;
<option value="Semester 1 Year 1">Semester 1 Year 1</option>;
<option value="Semester 2 Year 1">Semester 2 Year 1</option>;
<option value="Semester 1 Year 2">Semester 1 Year 2</option>;
<option value="Semester 2 Year 2">Semester 2 Year 2</option>;
<option value="Semester 1 Year 3">Semester 1 Year 3</option>;
<option value="Semester 2 Year 3">Semester 2 Year 3</option>;
<option value="Semester 1 Year 4">Semester 1 Year 4</option>;
<option value="Semester 2 Year 4">Semester 2 Year 4</option>;
</select>
</td>
</tr>
<tr>
<td><b>CGPA</b></td>
<td>:</td>
<td>
    <input type="text" name="cgpa" size="10" required placeholder="3.00">
</td>
</tr>

<tr>
<td colspan="3"><b>Student Activities*</b></td>
</tr>
<tr>
<td>1. Faculty Level</td>
<td>:</td>
<td>
    <input type="text" name="activities_FL" size="10" required>
</td>
</tr>
<tr>
<td>2. University Level</td>
<td>:</td>
<td>
    <input type="text" name="activities_UL" size="10" required>
</td>
</tr>
<tr>
<td>3. National Level</td>
<td>:</td>
<td>
    <input type="text" name="activities_NL" size="10" required>
</td>
</tr>
<tr>
<td>4. International Level</td>
<td>:</td>
<td>
    <input type="text" name="activities_IL" size="10" required>
</td>
</tr>

<tr>
<td colspan="3"><b>Competition*</b></td>
</tr>
<tr>
<td>1. Faculty Level</td>
<td>:</td>
<td>
    <input type="text" name="competition_FL" size="10" required>
</td>
</tr>
<tr>
<td>2. University Level</td>
<td>:</td>
<td>
    <input type="text" name="competition_UL" size="10" required>
</td>
</tr>
<tr>
<td>3. National Level</td>
<td>:</td>
<td>
    <input type="text" name="competition_NL" size="10" required>
</td>
</tr>
<tr>
<td>4. International Level</td>
<td>:</td>
<td>
    <input type="text" name="competition_IL" size="10" required>
</td>
</tr>
<tr>
<td>Leadership*</td>
<td>:</td>
<td>
    <input type="text" name="leadership" size="10" required>
</td>
</tr>
<tr>
<td>Graduate Aim*</td>
<td>:</td>
<td>
    <input type="text" name="graduate_aim" size="10" required>
</td>
</tr>
<tr>
<td>Professional Certification*</td>
<td>:</td>
<td>
    <input type="text" name="professional_cert" size="10" required>
</td>
</tr>

<tr>
<td>Mobility Program*</td>
<td>:</td>
<td>
    <input type="text" name="mobility_program" size="10" required>
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