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
<style>
table{
	width: 100%;
	border: 1px solid;
}

th,td{
	padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:nth-child(odd){background-color: #6CB4EE;}
tr:nth-child(even){background-color: #89cff0;}
tr:hover {background-color: #C8B4BA;}


</style>
</head>
<body>
    <div class="header"></div>
<?php include 'menu.php';?>
	</div>
	<div class="userAuth">
		<?php 
		//login&logout section
		if(isset($_SESSION["SID"])){
			echo '<b> '. $_SESSION["userName"] . '</b> <a href="logout.php">| Logout |</a> &nbsp;&nbsp;&nbsp; <br>';		
		}			
		else {
			echo '<a href="index.php?login=1">| Login |</a> &nbsp;&nbsp;&nbsp; <br>';
		}
		?>
	</div>
	
<h1>My Profile</h1>
<?php echo '<a href="edit_profile.php"> Edit Profile </a>';?>
    <div class="row">
		<div class="col-left">
			<?php
			$target_dir = "uploads/profile_pics/";
			$imgpath = isset($row["imgpath"]) ? $row["imgpath"] : ""; 
            if (!empty($imgpath)) {
				echo '<img class="image" src="' . $target_dir . $imgpath . '">';
			} else {
				echo '<img class="image" src="img/avatar.png">';
				}

            ?>
		</div>
		<div class="col-right">
			<table>
				<tr>
					<td width="164">Name</td>
					<td><?php echo $userName; ?></td>
				</tr>
				<tr>
					<td width="164">Matric No.</td>
					<td><?php echo $studentID; ?></td>
				</tr>
				<tr>
					<td width="164">Email</td>
					<td><?php echo $userEmail; ?></td>
				</tr>
				<tr>
					<td width="164">Phone No</td>
					<td><?php echo $phoneNo; ?></td>
				</tr>
				<tr>
					<td width="164">Program</td>
					<td><?php echo $program; ?></td>
				</tr>
				<tr>
					<td width="164">Intake Batch</td>
					<td><?php echo $intakeBatch; ?></td>
				</tr>
				<tr>
					<td width="164">Mentor Name</td>
					<td><?php echo $mentorName; ?></td>
				</tr>
				<tr>
					<td width="164">Address</td>
					<td><?php echo $address; ?></td>
				</tr>
				<tr>
					<td width="164">State</td>
					<td><?php echo $state; ?></td>
				</tr>

			</table>
			<p>My Study Motto</p>
			<table>
				<tr>
					<td><?php echo $studyMotto; ?></td>
				</tr>
			</table>
		</div>
	</div>
	<footer>
	<small><i>Copyright &copy; 2023 - Leong Jie Wen</i></small>
	</footer>
	
	
</body>
</html>
