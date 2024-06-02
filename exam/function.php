<?php
require_once "config.php";

// Choose a function depending on the value of $_POST["action"]
if ($_POST["action"] == "update") {
    update();
}

// Function to handle update
function update() {
    global $conn;

    // Assuming you're passing these values via AJAX
    $questionNumber = $_POST["questionNumber"];
    $selectedAnswer = $_POST["answer"];
    $q_id = $_POST["q_id"]; // Retrieve the q_id value
    $ed_id = $_POST["ed_id"]; // Retrieve the ed_id value


    $update_query = mysqli_query($conn, "UPDATE ques SET u_ans = '$selectedAnswer' WHERE ed_id = '$ed_id' AND q_id = '$questionNumber'");
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $updateQuery);
    
    // Check if prepare() succeeded
    if (!$stmt) {
        // Output error if prepare fails
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        return;
    }
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $selectedAnswer, $ed_id, $q_id);
    
    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Output
        echo 1; // Success
    } else {
        // Output
        echo 0; // Failure
    }
}
?>
