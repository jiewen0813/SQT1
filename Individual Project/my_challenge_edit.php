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
<div class="header"></div>
<?php include 'menu.php';?>
<h1>My Challenge</h1>

<?php
$id = "";
$sem = "";
$year = "";
$challenge = "";
$plan = "";
$remark = "";
$img = "";
if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];

    // Prepare and execute the statement to retrieve the challenge details
    $stmt = $conn->prepare("SELECT * FROM challenge WHERE ch_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sem = $row["sem"];
        $year = $row["year"];
        $challenge = $row["challenge"];
        $plan = $row["plan"];
        $remark = $row["remark"];
        $img = $row["img_path"];
    }
}
mysqli_close($conn);
?>
<div style="padding:0 10px;" id="challengeDiv">
    <h3 align="center">Edit Challenge and Plan</h3>
    <p align="center">Required field with mark*</p>
    <form method="POST" action="my_challenge_edit_action.php" id="myForm" enctype="multipart/form-data">
        <!--hidden value: id to be submitted to action page-->
        <input type="text" id="ch_id" name="ch_id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" hidden>
        <table border="1" id="myTable">
            <tr>
                <td>Semester*</td>
                <td width="1px">:</td>
                <td>
                    <select size="1" name="sem" required>
                        <option value="">&nbsp;</option>
                        <option value="1" <?= $sem == "1" ? 'selected' : '' ?>>1</option>
                        <option value="2" <?= $sem == "2" ? 'selected' : '' ?>>2</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Year*</td>
                <td>:</td>
                <td>
                    <input type="text" name="year" size="5" value="<?= $year ?>" required>
                </td>
            </tr>
            <tr>
                <td>Challenge*</td>
                <td>:</td>
                <td>
                    <textarea rows="4" name="challenge" cols="20" required><?= $challenge ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Plan*</td>
                <td>:</td>
                <td>
                    <textarea rows="4" name="plan" cols="20" required><?= $plan ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Remark</td>
                <td>:</td>
                <td>
                    <textarea rows="4" name="remark" cols="20"><?= $remark ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Photo</td>
                <td>:</td>
                <td>
                    <input type="text" disabled value="<?= $img ?>">
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
