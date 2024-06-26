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
<main>
	<h1>My Activities</h1>
	<?php echo '<a href="my_activities_create.php"> Add Activities </a>';?><br><br>
	<h2>List of Activities</h2>
	<table width="100%" border="1" id="projectable">
<tr>
	<th>No</th>
	<th>Sem & Year</th>
	<th>Name of Activities/Club/Association/Competition</th>
	<th>Position</th>
	<th>Photo</th>
	<th>&nbsp;</th>
</tr>
<?php
$sql = "SELECT * FROM activities WHERE studentID = '$studentID'";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
$numrow=1;
while($row = mysqli_fetch_assoc($result)) {
echo "<tr>";
echo "<td>" . $numrow . "</td><td>". $row["sem"] . " " . $row["year"]. "</td><td>" . $row["activities"] . "</td>
<td>" . $row["position"] . "</td><td>" . $row["img_path"] . "</td>";
echo '<td> <a href="my_activities_edit.php?id=' . $row["ac_id"] . '">Edit</a>&nbsp;|&nbsp;';
echo '<a href="my_activities_delete.php?id=' . $row["ac_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
echo "</tr>" . "\n\t\t";
$numrow++;
}
} else {
echo '<tr><td colspan="6">0 results</td></tr>';
}
mysqli_close($conn);
?>
</table>
<footer>
	<small><i>Copyright &copy; 2023 - Leong Jie Wen</i></small>
	</footer>
</main>
</body>
</html>