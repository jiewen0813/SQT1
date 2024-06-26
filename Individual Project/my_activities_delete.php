<?php
include 'config.php';

if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];

    // Retrieve the image path before deleting the record
    $getImagePathQuery = "SELECT img_path FROM activities WHERE ac_id=?";
    $stmt = $conn->prepare($getImagePathQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $imagePath = $row["img_path"];

        // Delete the record from the activities table
        $deleteActivitiesQuery = "DELETE FROM activities WHERE ac_id=?";
        $deleteStmt = $conn->prepare($deleteActivitiesQuery);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            echo "Record deleted successfully.<br>";

            // Check if there's an image associated with the record
            if (!empty($imagePath) && file_exists("uploads/activities/" . $imagePath)) {
                // If the image exists, delete it
                unlink("uploads/activities/" . $imagePath);
                echo "Image deleted successfully.<br>";
            }

            echo '<a href="my_activities.php">Back</a>';
        } else {
            echo "Error deleting record: " . $deleteStmt->error . "<br>";
            echo '<a href="my_activities.php">Back</a>';
        }
    } else {
        echo "Error retrieving image path: " . $stmt->error . "<br>";
        echo '<a href="my_activities.php">Back</a>';
    }

    $stmt->close();
    $deleteStmt->close();
}

mysqli_close($conn);
?>
