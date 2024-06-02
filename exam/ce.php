<?php
require_once "config.php";

session_start();

// Check if user is logged in
if (!isset($_SESSION['mainid'])) {
    header("location: login.php");
    exit();
}

// Database connection should be established in config.php
if($_SESSION['mainid']){

    if(isset($_POST['submit'])) {
        $en = $_POST['en'];
        $pass = $_POST['dn'];
        $fn = $_POST['tn']; 
        $dn = $_POST['du']; 
        $hours = $_POST['hours'];
        $minutes = $_POST['minutes'];
    
        // Combine hours and minutes into a single string formatted as "hh:mm"
        $duration = sprintf("%02d:%02d", $hours, $minutes);
    
        $mb = $_POST['tot'];
    
        $insert_query = mysqli_query($conn, "INSERT INTO exam_details (name, date, start_time, end_time, duration, t_marks) VALUES ('$en', '$pass', '$fn', '$dn', '$duration', '$mb')");
    
        if ($insert_query) {
            // Redirect to ce1.php after successful insertion
            echo "<script>window.location.href = 'ce2.php';</script>";
            exit();
        } else {
            // Handle insertion failure
            echo "Error: " . mysqli_error($conn);
        }
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
            /* background-color: rgb(255, 255, 255); */
            background-image: url('./eim1.jpeg');
        }


        .c1{
            background-color:rgb(62, 80, 141);
            margin:0;
            padding:0;
            height:fit-content;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="c1">
        <h1 class="display-4" style="color: aliceblue;font-family: 'Times New Roman', Times, serif;">TestMate Exam Portal</h1>
        <h6  style="color: rgb(137, 195, 194);"><i>Unlock your potential, one question at a time</i></h6>
        <div style="text-align: right;padding-right:10px;padding-bottom:10px;paddin-top:-10px;">
        <a href="logout.php"><input type="submit" class="btn btn-light" value="Logout"></a>
        </div>
    </div><br><br><br>

        <div class="container text-center" style="border: 2px solid black; background-color: white;width: fit-content;padding: 50px;">
        <h1>Enter Exam Details</h1><br>
        <form id="registrationForm" method="post" action="">

        <div class="mb-3 row">
    <label for="en" class="col-sm-3 col-form-label">Name of Exam: </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="en" name="en">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="dn" class="col-sm-3 col-form-label">Date of Exam: </label>
    <div class="col-sm-9">
      <input type="date" class="form-control" id="dn" name="dn">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="tn" class="col-sm-3 col-form-label">Start Time of Exam: </label>
    <div class="col-sm-9">
      <input type="time" class="form-control" id="tn" name="tn">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="du" class="col-sm-3 col-form-label">End of Exam:</label>
    <div class="col-sm-9">
      <input type="time" class="form-control" id="du" name="du">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="duration" class="col-sm-3 col-form-label">Duration (hh:mm):</label>
    <div class="col-sm-9">
        <div class="input-group">
            <input type="number" class="form-control" id="hours" name="hours" placeholder="Hours" min="0" max="3">
            <span class="input-group-text">:</span>
            <input type="number" class="form-control" id="minutes" name="minutes" placeholder="Minutes" min="0" max="59">
        </div>
    </div>
</div>



<div class="mb-3 row">
    <label for="firstName" class="col-sm-3 col-form-label">Total marks:</label>
    <div class="col-sm-9">
      <input type="number" class="form-control" id="tot" name="tot">
    </div>
</div>


  <!-- <div class="mb-3 row">
    <label for="sec" class="col-sm-3 col-form-label">No. of sections:</label>
    <div class="col-sm-9">
      <input type="number" class="form-control" id="sec" name="sec">
    </div>
  </div> -->

  

  <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Submit" />
  <input type="button" class="btn btn-dark" id="back" name="back" value="Go Back" />

</form>
      </div><br><br>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('d').addEventListener('change', function() {
        var duration = this.value;
        var regex = /^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/;
        if (!regex.test(duration)) {
            Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Please enter duration in the format hh:mm (e.g., 01:30)'
        });
        return true;
        }
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
