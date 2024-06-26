<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>My Study KPI</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header">
</div>
<?php include 'menu.php';?>
<h1>My Activities</h1>
<?php
$id = "";
$sem = "";
$year = "";
$activities = "";
$position = "";
$img = "";

if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];

    $sql = "SELECT * FROM activities WHERE ac_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $id = $row["ac_id"];
        $sem = $row["sem"];
        $year = $row["year"];
        $activities = $row["activities"];
        $position = $row["position"];
        $img = $row["img_path"];
    }

    $stmt->close();
}

mysqli_close($conn);
?>
<div style="padding:0 10px;" id="challengeDiv">
<h3 align="center">Edit Activities</h3>
<p align="center">Required field with mark*</p>
<form method="POST" action="my_activities_edit_action.php" id="myForm" enctype="multipart/form-data">
<!--hidden value: id to be submitted to action page-->
<input type="text" id="ac_id" name="ac_id" value="<?= isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '' ?>" hidden>

<table border="1" id="myTable">
<tr>
<td>Semester*</td>
<td width="1px">:</td>
<td>
<select size="1" name="sem" required>
<option value="">&nbsp;</option>
<?php
if ($sem == "1")
    echo '<option value="1" selected>1</option>';
else
    echo '<option value="1">1</option>';
if ($sem == "2")
    echo '<option value="2" selected>2</option>';
else
    echo '<option value="2">2</option>';
?>
</select>
</td>
</tr>
<tr>
<td>Year*</td>
<td>:</td>
<td>
<?php
if ($year != "") {
    echo '<input type="text" name="year" size="5" value="' . htmlspecialchars($year) . '" required>';
} else {
    ?>
    <input type="text" name="year" size="5" required>
    <?php
}
?>
</td>
</tr>
<tr>
<td>Activities*</td>
<td>:</td>
<td>
<textarea rows="4" name="activities" cols="30" required><?php echo htmlspecialchars($activities);?></textarea>
</td>
</tr>
<tr>
<td>Position*</td>
<td>:</td>
<td>
<textarea rows="4" name="position" cols="30" required><?php echo htmlspecialchars($position);?></textarea>
</td>
</tr>
<tr>
<td>Photo</td>
<td>:</td>
<td>
<input type="text" disabled value="<?= htmlspecialchars($img); ?>">
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
<input type="reset" value="Reset" name="B2" onclick="resetForm()">
<input type="button" value="Clear" name="B3" onclick="clearForm()">
</td>
</tr>
</table>
</form>
</div>
<p></p>
<footer>
<p>Copyright (c) 2023 - My Name</p>
</footer>
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

//reset form after modification to a php echo to fields
function resetForm() {
    document.getElementById("myForm").reset();
}

//this clear form to empty the form for new data
function clearForm() {
    var form = document.getElementById("myForm");
    if (form) {
        var inputs = form.getElementsByTagName("input");
        var textareas = form.getElementsByTagName("textarea");
        //clear select
        form.getElementsByTagName("select")[0].selectedIndex = 0;
        //clear all inputs
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type !== "button" && inputs[i].type !== "submit" && inputs[i].type !== "reset") {
                inputs[i].value = "";
            }
        }
        //clear all textareas
        for (var i = 0; i < textareas.length; i++) {
            textareas[i].value = "";
        }
    } else {
        console.error("Form not found");
    }
}
</script>
</body>
</html>
