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

    // Step 1: Retrieve the most recent ed_id from the exam_details table
    $exam_id_query = mysqli_query($conn, "SELECT ed_id FROM exam_details ORDER BY ed_id DESC LIMIT 1");
    $exam_id_result = mysqli_fetch_assoc($exam_id_query);
    $exam_id = $exam_id_result['ed_id'];

    // echo "Exam ID: " . $exam_id;


    // Step 2: Update the session variable meanid with this value
    $_SESSION['meanid'] = $exam_id;

    if(isset($_POST['submit'])) {
        $ques = $_POST['q1'];
        $a = $_POST['o1'];
        $b = $_POST['o2']; 
        $em = $_POST['o3'];
        $mb = $_POST['o4'];
        $ans = $_POST['ans'];

        // Step 3: Insert this ed_id value into the ques table along with the question details
        $insert_query = mysqli_query($conn, "INSERT INTO ques (exam_id, question, a, b, c, d, ans) VALUES ('$exam_id', '$ques', '$a', '$b', '$em', '$mb','$ans')");

        if ($insert_query) {
            // Redirect to ce1.php after successful insertion
            echo "<script>window.location.href = 'ce2.php';</script>";
        } else {
            // Handle insertion failure
            echo "Error: " . mysqli_error($conn);
        }
    }

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    $deleteqry = mysqli_query($conn, "UPDATE ques SET status='0' WHERE q_id='$delete_id'") or die(mysqli_error($conn));
  
    if ($deleteqry) {
        // echo "delete success";
        echo "";
    } else {
        // echo "delete error";
        echo "";
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
            <label for="en" class="col-sm-3 col-form-label">Enter Question: </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="q1" name="q1">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="en" class="col-sm-3 col-form-label">Option 1: </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="o1" name="o1">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="en" class="col-sm-3 col-form-label">Option 2: </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="o2" name="o2">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="en" class="col-sm-3 col-form-label">Option 3:</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="o3" name="o3">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="en" class="col-sm-3 col-form-label">Option 4:</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="o4" name="o4">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="en" class="col-sm-3 col-form-label">Answer: </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="ans" name="ans">
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

      <div class="container text-center" style="border: 2px solid black; background-color: white;width: fit-content;padding: 40px;">
        <div class="row">
            <div class="col" style="text-align: center;justify-content: center; align-items: center;">
                <form action="" method="post">
                       
    </form>
    <?php
// Select the most recent ed_id from exam_details table
$get_ed_id = mysqli_query($conn, "SELECT MAX(ed_id) AS max_ed_id FROM exam_details") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($get_ed_id);
$max_ed_id = $row['max_ed_id'];

// Select questions using the most recent ed_id
$get_questions = mysqli_query($conn, "SELECT question, a, b, c, d,ans 
                                       FROM ques 
                                       WHERE exam_id = '$max_ed_id' AND status='1'") 
                  or die(mysqli_error($conn));

// Check if there are any questions available
if (mysqli_num_rows($get_questions) > 0) {
    ?>

    <table class="table table-bordered" style="text-align:center;">
        <tr>
            <th>Question</th>
            <th>Option A</th>
            <th>Option B</th>
            <th>Option C</th>
            <th>Option D</th>
            <th>Answer</th>

        </tr>

        <?php
        while ($question_row = mysqli_fetch_assoc($get_questions)) {
            ?>
            <tr>
                <td><?php echo $question_row['question']; ?></td>
                <td><?php echo $question_row['a']; ?></td>
                <td><?php echo $question_row['b']; ?></td>
                <td><?php echo $question_row['c']; ?></td>
                <td><?php echo $question_row['d']; ?></td>
                <td><?php echo $question_row['ans']; ?></td>

            </tr>
            <?php
        }
        ?>
    </table>

<?php
} else {
    // Display a message indicating no questions are available
    echo "No questions created for the most recent exam.";
}
?>
      
            </div>
        </div>
    </div><br><br>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
