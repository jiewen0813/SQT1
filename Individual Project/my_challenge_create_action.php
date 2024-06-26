<?php
include 'config.php';

// Variables
$action = "";
$id = "";
$sem = "";
$year = "";
$challenge = "";
$remark = "";

// For upload
$target_dir = "uploads/challenge/";
$target_file = "";
$uploadOk = 0;
$imageFileType = "";
$uploadfileName = "";

// Retrieve studentID from the form
$studentID = isset($_POST["studentID"]) ? $_POST["studentID"] : "";

// This block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Values for add or edit
    $id = isset($_POST["ch_id"]) ? $_POST["ch_id"] : "";
    $sem = isset($_POST["sem"]) ? $_POST["sem"] : "";
    $year = isset($_POST["year"]) ? $_POST["year"] : "";
    $challenge = isset($_POST["challenge"]) ? trim($_POST["challenge"]) : "";
    $plan = isset($_POST["plan"]) ? trim($_POST["plan"]) : "";
    $remark = isset($_POST["remark"]) ? trim($_POST["remark"]) : "";
    $filetmp = isset($_FILES["fileToUpload"]) ? $_FILES["fileToUpload"] : "";
    $uploadfileName = isset($filetmp["name"]) ? $filetmp["name"] : "";

    // Check if there is an image to be uploaded
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] == "") {
        // Prepare the SQL statement
        $sql = "INSERT INTO challenge (studentID, sem, year, challenge, plan, remark, img_path)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisssss", $studentID, $sem, $year, $challenge, $plan, $remark, $uploadfileName);

        // Execute the statement
        $status = $stmt->execute();

        if ($status) {
            echo "Form data saved successfully!<br>";
            echo '<a href="my_challenge.php">Back</a>';
        } else {
            echo '<a href="my_challenge.php">Back</a>';
        }
    } else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        // Variable to determine if image upload is OK
        $uploadOk = 1;
        $filetmp = $_FILES["fileToUpload"];
        $uploadfileName = $filetmp["name"];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "ERROR: Sorry, image file $uploadfileName already exists.<br>";
            $uploadOk = 0;
        }

        // Check file size <= 500000 bytes (488.28KB)
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "ERROR: Sorry, your file is too large. Try resizing your image.<br>";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        // If uploadOk is true, try to add to the database first
        if ($uploadOk) {
            // Prepare the SQL statement
            $sql = "INSERT INTO challenge (studentID, sem, year, challenge, plan, remark, img_path)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sisssss", $studentID, $sem, $year, $challenge, $plan, $remark, $uploadfileName);

            // Execute the statement
            $status = $stmt->execute();

            if ($status) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    // Image file successfully uploaded
                    echo "Form data saved successfully!<br>";
                    echo '<a href="my_challenge.php">Back</a>';
                } else {
                    // Error while uploading the image
                    echo "Sorry, there was an error uploading your file.<br>";
                    echo '<a href="javascript:history.back()">Back</a>';
                }
            } else {
                echo '<a href="javascript:history.back()">Back</a>';
            }
        } else {
            echo '<a href="javascript:history.back()">Back</a>';
        }
    }
}

// Close DB connection
mysqli_close($conn);
?>
