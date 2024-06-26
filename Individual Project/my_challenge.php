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
	<?php echo '<a href="my_challenge_create.php"> Add Challenge and Plan </a>';?><br><br>
<h2>List of Challenge and Plan</h2>

<table border="1" width="100%" id="projectable">
<tr>
<th width="5%">No</th>
<th width="10%">Sem & Year</th>
<th width="30%">Challenge</th>
<th width="30%">Plan</th>
<th width="15%">Remark</th>
<th width="10%">Photo</th>
<th width="10%">&nbsp;</th>
</tr>
<?php
$sql = "SELECT * FROM challenge WHERE studentID = '$studentID'";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
$numrow=1;
while($row = mysqli_fetch_assoc($result)) {
echo "<tr>";
echo "<td>" . $numrow . "</td><td>". $row["sem"] . " " . $row["year"]. "</td><td>" . $row["challenge"] .
"</td><td>" . $row["plan"] . "</td><td>" . $row["remark"] . "</td><td>" . $row["img_path"] . "</td>";
echo '<td> <a href="my_challenge_edit.php?id=' . $row["ch_id"] . '">Edit</a>&nbsp;|&nbsp;';
echo '<a href="my_challenge_delete.php?id=' . $row["ch_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
echo "</tr>" . "\n\t\t";
$numrow++;
}
} else {
echo '<tr><td colspan="6">0 results</td></tr>';
}
mysqli_close($conn);
?>
</table>
<p></p>
<footer>
	<small><i>Copyright &copy; 2023 - Leong Jie Wen</i></small>
	</footer>


</body>
</html>
