<?php
include 'config.php';

if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];

    // Prepare the statement to retrieve the image path
    $getImagePathQuery = "SELECT img_path FROM challenge WHERE ch_id = ?";
    $stmt = $conn->prepare($getImagePathQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $imagePath = $row["img_path"];

        // Prepare the statement to delete the record
        $deleteChallengeQuery = "DELETE FROM challenge WHERE ch_id = ?";
        $stmt = $conn->prepare($deleteChallengeQuery);
        $stmt->bind_param("i", $id);
        $status = $stmt->execute();

        if ($status) {
            echo "Record deleted successfully.<br>";

            // Check if there's an image associated with the record
            if (!empty($imagePath) && file_exists("uploads/challenge/" . $imagePath)) {
                // If the image exists, delete it
                unlink("uploads/challenge/" . $imagePath);
                echo "Image deleted successfully.<br>";
            }

            echo '<a href="my_challenge.php">Back</a>';
        } else {
            echo "Error deleting record: " . $conn->error . "<br>";
            echo '<a href="my_challenge.php">Back</a>';
        }
    } else {
        echo "Error retrieving image path: " . $conn->error . "<br>";
        echo '<a href="my_challenge.php">Back</a>';
    }
}

mysqli_close($conn);
?>

