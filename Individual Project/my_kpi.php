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
	<h1>My Study KPI</h1>
	<?php echo '<a href="my_kpi_create.php"> Add KPI Indicator </a>';?><br><br>
<main>
	
<table border="1" width="100%" id="projectable">
<?php
if (isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];
    
    $fetchSql = "SELECT * FROM indicator WHERE studentID = $studentID";
    $result = $conn->query($fetchSql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userChoice = $row['userChoice']; // Assuming 'userChoice' is a column in your table
    } else {
        echo "Error: Review not found";
    }
    
    mysqli_close($conn);
}
?>
	
<tr>
	<th>No</th>
	<th>Indicator</th>
	<th>Faculty KPI</th>
	<th><?php echo $userChoice;?></th>
</tr>
<tr>
	<td>1</td>
	<td><b>CGPA</b></td>
	<td><b>>=3.00</b></td>
	
</tr>
<tr>
	<td align="center" rowspan="5">2</td> <!-- The rowspan usage -->
	<td colspan="6"><b>STUDENT ACTIVITIES</b></td> <!-- The colspan usage -->
</tr>
<tr>
	<td>Faculty Level</td>
	<td><b>4</b></td>
</tr>
<tr>
	<td>University Level</td>
	<td><b>4</b></td>
</tr>
<tr>
	<td>National Level</td>
	<td><b>1</b></td>
</tr>
<tr>
	<td>International Level</td>
	<td><b>1</b></td>
</tr>
<tr>
	<td align="center" rowspan="5">3</td> <!-- The rowspan usage -->
	<td colspan="6"><b>COMPETITION</b></td> <!-- The colspan usage -->
</tr>
<tr>
	<td>Faculty Level</td>
	<td><b>2</b></td>
</tr>
<tr>
	<td>University Level</td>
	<td><b>2</b></td>
</tr>
<tr>
	<td>National Level</td>
	<td><b>1</b></td>
</tr>
<tr>
	<td>International Level</td>
	<td><b>1</b></td>
</tr>
<tr>
	<td>4</td>
	<td><b>LEADERSHIP</b><br><i>As a higher committee member or normal committee member</i></td>
	<td><b>2</b></td>
</tr>
<tr>
	<td>5</td>
	<td><b>GRADUATE AIM</b><br><i>Graduate on Time</i></td>
	<td><b>On Time</b></td>
</tr>
<tr>
	<td>6</td>
	<td><b>PROFESSIONAL CERTIFICATION</b></td>
	<td><b>>=1</b></td>
</tr>
<tr>
	<td>7</td>
	<td><b>EMPLOYABILITY</b></td>
	<td colspan="4"><b>Within 3 months after Industrial Training</td>
</tr>
<tr>
	<td>8</td>
	<td><b>MOBILITY PROGRAM</td>
	<td><b>1</b></td>
</tr>
</table>
<footer>
	<small><i>Copyright &copy; 2023 - Leong Jie Wen</i></small>
	</footer>
</main>
</body>
</html>