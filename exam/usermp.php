<?php
require_once "config.php";

session_start();
$mainid = $_SESSION['mainid'];
// echo $mainid;
// return;

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['mainid'])) {
    header("location: login.php"); // Redirect to login page if user is not logged in
    exit(); // Stop further execution
}

if($_SESSION['mainid']){

if (isset($_POST['submit_id'])) {
    $submit_id = $_POST['submit_id'];
    // Update your database or perform other necessary actions here
    // Example: mysqli_query($conn, "UPDATE exam_details SET status = 'started' WHERE ed_id = $submit_id");
}

$qry4 = mysqli_query($conn, "SELECT name FROM e_login WHERE status='1' AND id='$mainid'") or die(mysqli_error($conn));

if ($qry4) {
    $r4 = mysqli_fetch_assoc($qry4);
    $a4 = $r4['name'];
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

    <div class="container text-center" style="border: 2px solid black; background-color: white;width: fit-content;padding: 40px;">
    <div style="padding-left:20px;"><h2>Welcome, <b><?php echo isset($a4) ? $a4 : ''; ?>!</b></h2></div>

    <div class="row">
        <div class="col" style="text-align: center;justify-content: center; align-items: center;">
            <h3>Current Exams</h3>
            <div class="table-responsive">

            <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Display your terms and conditions here -->
            <h2>Terms and Conditions</h2>
            <p>Your terms and conditions content goes here...</p>
        </div>
    </div>

            <table class="table table-bordered" style="text-align:center;">
                <tr>
                    <th>S.No</th>
                    <th>Exam Name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <!-- <th>End Time</th> -->
                    <th>Total Marks</th>
                    <th>Status</th>
                </tr>
                <?php
                date_default_timezone_set('Asia/Kolkata');

                $getdata = mysqli_query($conn,"SELECT ed_id,name,date,start_time,end_time,t_marks FROM exam_details WHERE status='1' ORDER BY date,start_time ASC") or die(mysqli_error($conn));
                if (!$getdata) {
                    die('Invalid query: ' . mysqli_error($conn));
                }
                $i = -9;


                while ($getvalues = mysqli_fetch_object($getdata)) {
                    $date = $getvalues->date;
                    $start_time = $getvalues->start_time;
                    $end_time = $getvalues->end_time;

                    // Concatenate date and time strings to form full datetime strings
                    $startDateTime = strtotime("$date $start_time");
                    $endDateTime = strtotime("$date $end_time");
                    $currentDateTime = strtotime("now");

                    if ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime) {
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $getvalues->name;?></td>
                    <td><?php echo date('d-m-Y', strtotime($date)); ?></td>
                    <td><?php echo $start_time;?></td>
                    <!-- <td><?php echo $end_time;?></td> -->
                    <td><?php echo $getvalues->t_marks;?></td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="ed_id" value="<?php echo $getvalues->ed_id; ?>">
                            <button type="submit" id="sub_exam" class="btn btn-primary" data-ed-id="<?php echo $getvalues->ed_id; ?>">Start Exam</button>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                    $i++;
                }
                ?>
            </table></div>

            <h3>Upcoming Exams</h3>
            <table class="table table-bordered" style="text-align:center;">
                <tr>
                    <th>S.No</th>
                    <th>Exam Name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <!-- <th>End Time</th> -->
                    <th>Total Marks</th>
                    <th>Status</th>
                </tr>
                <?php
                mysqli_data_seek($getdata, 0); // Reset pointer to fetch data from the start
                $i = 1;

                while ($getvalues = mysqli_fetch_object($getdata)) {
                    $date = $getvalues->date;
                    $start_time = $getvalues->start_time;
                    $end_time = $getvalues->end_time;
                    $startDateTime = strtotime("$date $start_time");
                    $endDateTime = strtotime("$date $end_time");
                    $currentDateTime = strtotime("now");

                    if ($currentDateTime < $startDateTime) {
                        $timeRemaining = $startDateTime - $currentDateTime;
                        $days = floor($timeRemaining / (60 * 60 * 24));
                        $hours = floor(($timeRemaining % (60 * 60 * 24)) / 3600);
                        $minutes = floor(($timeRemaining % 3600) / 60);
                        $seconds = $timeRemaining % 60;
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $getvalues->name;?></td>
                    <td><?php echo date('d-m-Y', strtotime($date)); ?></td>
                    <td><?php echo $start_time;?></td>
                    <!-- <td><?php echo $end_time;?></td> -->
                    <td><?php echo $getvalues->t_marks;?></td>
                    <td>
                        <?php
                        if ($days > 0) {
                            echo "Time Remaining: $days days, $hours hours, $minutes minutes, $seconds seconds";
                        } else {
                            echo "Time Remaining: $hours hours, $minutes minutes, $seconds seconds";
                        }
                        ?>
                    </td>
                </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </table>

            <h3>Completed Exams</h3>
            <table class="table table-bordered" style="text-align:center;">
                <tr>
                    <th>S.No</th>
                    <th>Exam Name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <!-- <th>End Time</th> -->
                    <th>Total Marks</th>
                    <th>Status</th>
                </tr>
                <?php
                mysqli_data_seek($getdata, 0); // Reset pointer to fetch data from the start
                $i = 1;

                while ($getvalues = mysqli_fetch_object($getdata)) {
                    $date = $getvalues->date;
                    $start_time = $getvalues->start_time;
                    $end_time = $getvalues->end_time;
                    $startDateTime = strtotime("$date $start_time");
                    $endDateTime = strtotime("$date $end_time");
                    $currentDateTime = strtotime("now");

                    if ($currentDateTime > $endDateTime) {
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $getvalues->name;?></td>
                    <td><?php echo date('d-m-Y', strtotime($date)); ?></td>
                    <td><?php echo $start_time;?></td>
                    <!-- <td><?php echo $end_time;?></td> -->
                    <td><?php echo $getvalues->t_marks;?></td>
                    <td>Exam Completed</td>
                </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div><br><br>


<script>
    // Function to handle the click event on the "Start Exam" button
    document.querySelectorAll('#sub_exam').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault();
            
            // Retrieve the ed_id associated with the button
            const edId = item.getAttribute('data-ed-id');
            
            // Display SweetAlert confirmation dialog with terms and conditions
            Swal.fire({
                title: 'Terms and Conditions',
                html: `
                <ol>
                    <li>Academic Integrity: Students must uphold ethical standards, refraining from cheating, plagiarism, or any form of dishonest behavior during exams.</li><br>
                    <li>Exam Regulations: Students are required to adhere to all rules and guidelines outlined for the exam, including timing, materials allowed, and conduct expectations.</li><br>
                    <li>Confidentiality Agreement: Students must maintain the confidentiality of exam content and refrain from discussing questions or answers with others.</li><br>
                    <li>Prohibited Items: Students are prohibited from bringing unauthorized materials or devices into the exam venue, including electronic gadgets, notes, or communication devices.</li><br>
                    <li>Exam Conduct: Students must maintain silence, avoid communication with other candidates, and follow all instructions provided by invigilators during the exam.</li><br>
                    <li>Submission Deadlines: All exam papers or assignments must be submitted by the specified deadline to avoid penalties or disqualification.</li><br>
                    <li>Exam Security: Measures are in place to ensure the security and integrity of exam materials, and students must cooperate with all security protocols.</li><br>
                    <li>Special Accommodations: Students requiring special accommodations due to disabilities or special needs must notify the appropriate authorities in advance.</li><br>
                    <li>Attendance Requirement: Students must attend the exam at the scheduled time and venue unless prior arrangements have been made.</li><br>
                    <li>Academic Misconduct: Any form of academic dishonesty, including cheating, plagiarism, or unauthorized collaboration, will result in severe penalties.</li><br>
                </ol> 
                <label><input type="checkbox" id="agreeCheckbox"> I agree to the above terms and conditions</label>
                `,
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: 'Yes, start the exam',
                allowOutsideClick: false,
                preConfirm: () => {
                    // Check if the user has agreed to the terms and conditions
                    if (document.getElementById('agreeCheckbox').checked) {
                        // If agreed, redirect to start_exam.php with the ed_id as a query parameter
                        window.location.href = `start_exam.php?ed_id=${edId}`;
                    } else {
                        // If not agreed, display an error message
                        Swal.showValidationMessage('Please agree to the terms and conditions');
                    }
                },
                showLoaderOnConfirm: true,
                focusConfirm: false,
                didOpen: () => {
                    // Initially disable the "Yes, start the exam" button
                    Swal.getConfirmButton().disabled = true;
                    
                    // Add event listener to enable the button when the checkbox is checked
                    document.getElementById('agreeCheckbox').addEventListener('change', function() {
                        Swal.getConfirmButton().disabled = !this.checked;
                    });
                },
                customClass: {
                    popup: 'my-popup-class',
                },
            });
        });
    });
</script>

<style>
    .my-popup-class {
        width: 1000px; /* Adjust the width as needed */
    }
</style>




    <script>
        document.querySelectorAll('.submit-btn').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const formId = event.target.closest('form').getAttribute('id');
                document.getElementById(formId).submit();
            });
        });
    </script>

</body>
</html>
