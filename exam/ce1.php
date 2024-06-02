<?php
require_once "config.php";
session_start();

if (!isset($_SESSION['mainid'])) {
    header("location: login.php");
    exit();
}

if($_SESSION['mainid']){
    if(isset($_POST['proceed'])){
        $insertqry = mysqli_query($conn, "INSERT INTO exam_details (u_id, ftransfer) VALUES ('$storedMainid', '$wd')") or die(mysqli_error($conn));

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestMate Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body{
            margin: 0;
            padding: 0;
            background-image: url('./eim1.jpeg');
        }

        .c1{
            background-color:rgb(62, 80, 141);
            margin:0;
            padding:0;
            height:fit-content;
            text-align: center;
        }
        .error-message {
      color: red;
    }
    </style>
</head>
<body>
<div class="c1">
    <h1 class="display-4" style="color: aliceblue;font-family: 'Times New Roman', Times, serif;">TestMate Exam Portal</h1>
    <h6 style="color: rgb(137, 195, 194);"><i>Unlock your potential, one question at a time</i></h6>
    <div style="text-align: right;padding-right:10px;padding-bottom:10px;padding-top:-10px;">
        <a href="logout.php"><input type="submit" class="btn btn-light" value="Logout"></a>
    </div>
</div><br><br><br>

<div class="container text-center" style="border: 2px solid black; background-color: white;width: fit-content;padding: 50px;">
    <h1>Enter Exam Details</h1><br>
    <form id="registrationForm" method="post" action="process_exam_details.php" onsubmit="return validateForm()">
        <div id="sectionsContainer">
            <label for="sections">Number of Sections:</label>
            <input type="number" id="sections" name="sections" required class="form-control"><br>

        </div>

        <button type="submit" id="submit-btn" class="btn btn-primary" >Submit</button>
        <input type="button" class="btn btn-dark" id="back" name="back" value="Go Back" />

    </form>
</div><br><br>

<!-- <script>
    document.getElementById("sections").addEventListener("input", function(event) {
      const inputValue = event.target.value;
      const submitButton = document.getElementById("submit-btn");

      // Check if the input value is 1, 2, or 3
      if (inputValue === "1" || inputValue === "2" || inputValue === "3") {
        submitButton.disabled = false; // Enable the submit button
      } else {
        submitButton.disabled = true; // Disable the submit button
      }
    });
  </script> -->

<script>
    document.getElementById('sections').addEventListener('change', function() {
        var sections = parseInt(this.value);
        var sectionsContainer = document.getElementById('sectionsContainer');
        var html = '';
        for (var i = 1; i <= sections; i++) {
            html += '<label for="marks_section_' + i + '">Marks for Section ' + i + ':</label>';
            html += '<input type="number" id="marks_section_' + i + '" name="marks_section_' + i + '" min="0" required class="form-control"><br>';
            html += '<label for="type_section_' + i + '">Type of Questions in Section ' + i + ':</label>';
            html += '<select id="type_section_' + i + '" name="type_section_' + i + '" required class="form-select">';
            html += '<option value="multiple_choice">Multiple Choice</option>';
            html += '<option value="checkboxes">Checkboxes</option>';
            html += '<option value="descriptive">Descriptive</option>';
            html += '</select><br><br>';
        }
        sectionsContainer.innerHTML += html;
    });
</script>

<script>

  function checkEmptyFields() {
    var inputs = document.querySelectorAll('input[type="text"], input[type="time"], input[type="number"], input[type="date"]');
    var radioButtons = document.querySelectorAll('input[type="radio"][name="gender"]');
    var radioChecked = false;
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].value.trim() === '') {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Please fill all input fields.'
        });
        return true;
      }
    }
  }

  

  document.getElementById("registrationForm").addEventListener("submit", function(event) {
    if (checkEmptyFields()) {
      event.preventDefault(); 
    }
  });

  document.getElementById("back").addEventListener("click", function() {
    window.location.href = "adminmp.php"; 
});


</script>

</body>
</html>
