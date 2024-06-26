<?php
include 'config.php';

// Initialize variables
$action = "";
$id = "";
$userChoice = "";
$cgpa = "";
$activities_FL = "";
$activities_UL = "";
$activities_NL = "";
$activities_IL = "";
$competition_FL = "";
$competition_UL = "";
$competition_NL = "";
$competition_IL = "";
$leadership = "";
$graduate_aim = "";
$professional_cert = "";
$mobility_program = "";

// Retrieve studentID from the form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["studentID"])) {
    $studentID = $_POST["studentID"];

    // Values for add or edit
    $userChoice = isset($_POST["userChoice"]) ? $_POST["userChoice"] : "";
    $cgpa = isset($_POST["cgpa"]) ? $_POST["cgpa"] : "";
    $activities_FL = isset($_POST["activities_FL"]) ? trim($_POST["activities_FL"]) : "";
    $activities_UL = isset($_POST["activities_UL"]) ? trim($_POST["activities_UL"]) : "";
    $activities_NL = isset($_POST["activities_NL"]) ? trim($_POST["activities_NL"]) : "";
    $activities_IL = isset($_POST["activities_IL"]) ? trim($_POST["activities_IL"]) : "";
    $competition_FL = isset($_POST["competition_FL"]) ? trim($_POST["competition_FL"]) : "";
    $competition_UL = isset($_POST["competition_UL"]) ? trim($_POST["competition_UL"]) : "";
    $competition_NL = isset($_POST["competition_NL"]) ? trim($_POST["competition_NL"]) : "";
    $competition_IL = isset($_POST["competition_IL"]) ? trim($_POST["competition_IL"]) : "";
    $leadership = isset($_POST["leadership"]) ? $_POST["leadership"] : "";
    $graduate_aim = isset($_POST["graduate_aim"]) ? $_POST["graduate_aim"] : "";
    $professional_cert = isset($_POST["professional_cert"]) ? $_POST["professional_cert"] : "";
    $mobility_program = isset($_POST["mobility_program"]) ? $_POST["mobility_program"] : "";

    // Prepare SQL statement using prepared statement
    $sql = "INSERT INTO indicator (studentID, userChoice, cgpa, activities_FL, activities_UL, activities_NL, activities_IL, competition_FL, competition_UL, competition_NL, competition_IL, leadership, graduate_aim, professional_cert, mobility_program)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssssssssss", $studentID, $userChoice, $cgpa, $activities_FL, $activities_UL, $activities_NL, $activities_IL, $competition_FL, $competition_UL, $competition_NL, $competition_IL, $leadership, $graduate_aim, $professional_cert, $mobility_program);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Form data saved successfully!<br>";
        echo '<a href="my_kpi.php">Back</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo '<a href="my_kpi.php">Back</a>';
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
