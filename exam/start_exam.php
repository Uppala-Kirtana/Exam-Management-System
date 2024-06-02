<?php
require_once "config.php";

session_start();
$mainid = $_SESSION['mainid'];

// echo $mainid;
// return;

if (!isset($_SESSION['mainid'])) {
    header("location: login.php");
    exit();
}

if ($_SESSION['mainid']) {
    $mainid = $_SESSION['mainid']; // Move this line inside the conditional block

    // Retrieve the ed_id from the URL query parameters
    if (isset($_GET['ed_id'])) {
        $ed_id = $_GET['ed_id'];

        // Fetch duration from exam_details table
        $duration_query = mysqli_query($conn, "SELECT duration FROM exam_details WHERE ed_id = '$ed_id' AND status='1'");
        if ($duration_query) {
            $duration_row = mysqli_fetch_assoc($duration_query);
            $duration = $duration_row['duration'];
        } else {
            // Handle error if query fails
            echo "Error fetching duration: " . mysqli_error($conn);
            exit();
        }


        if (isset($_POST['save_and_next'])) {
            // Loop through each question submitted
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'answer-') === 0) {
                    $question_number = substr($key, strlen('answer-'));
                    $selected_answer = mysqli_real_escape_string($conn, $value);

                    // Execute update query to update u_ans in ques table
                    $update_query = mysqli_query($conn, "UPDATE ques SET u_ans = '$selected_answer' WHERE exam_id = '$ed_id' AND q_id = '$question_number'");
                    if (!$update_query) {
                        // Handle error if query fails
                        echo "Error updating answer for question $question_number: " . mysqli_error($conn);
                        exit();
                    }
                }
            }
            // Redirect or perform any other actions after updating answers
        }


       

        
$questions_query = mysqli_query($conn, "SELECT question, a, b, c, d FROM ques WHERE exam_id = '$ed_id' AND status='1'");

        // Array to store fetched questions
        $questions = array();

        // Fetch questions and store them in $questions array
        while ($row = mysqli_fetch_assoc($questions_query)) {
            $questions[] = $row;
        }
    } else {
        // If ed_id is not received, handle the error or redirect to appropriate page
        echo "Error: ed_id not received.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestMate Exam Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
    body {
        margin: 0;
        padding: 0;
        background-image: url('./eim1.jpeg');
    }

    .c1 {
        background-color: rgb(62, 80, 141);
        margin: 0;
        padding: 0;
        height: fit-content;
        text-align: center;
    }

    .question-container {
        border-right: 2px solid black;
    }

    .list-group-item {
        border: none !important; /* Remove all borders */
        outline: none !important; /* Remove outlines */
    }

    .question {
        display: none;
    }

    .btn-group .btn {
        margin-right: 10px;
        border-radius: 15px; /* Rounded corners */
    }
    .question-button.answered {
    background-color: green; /* Change color to green when an option is selected */
}
    .question-button.unanswered {
        background-color: red; /* Change color to red for unanswered questions */
    }

    #timer {
        font-size: 24px;
        margin-bottom: 20px;
    }
    #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white; /* Change this to whatever background color you want */
            z-index: 9999; /* Ensure this is above everything else */
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

    <div class="container" style="border: 2px solid black; background-color: white;padding: 40px;">
        <div class="row">
            
            <div class="col-8 question-container">
                <h2>Exam Questions</h2>
                <form id="questionForm" method="post">
                    <ul class="list-group">
                        <?php 
                        $i = 1;
                        foreach ($questions as $question): 
                        ?>
                            <li class="list-group-item question" id="question-<?php echo $i; ?>">
                                <input type="hidden" name="question-number" value="<?php echo $i; ?>">
                                <strong>Question <?php echo $i; ?>:</strong> <?php echo $question['question']; ?><br>
                                <label><input type="radio" name="answer-<?php echo $i; ?>" value="A"> <?php echo $question['a']; ?></label><br>
                                <label><input type="radio" name="answer-<?php echo $i; ?>" value="B"> <?php echo $question['b']; ?></label><br>
                                <label><input type="radio" name="answer-<?php echo $i; ?>" value="C"> <?php echo $question['c']; ?></label><br>
                                <label><input type="radio" name="answer-<?php echo $i; ?>" value="D"> <?php echo $question['d']; ?></label><br>
                                <button type="button" class="btn btn-info save-next-button" >Save and Next</button>
                            </li>
                        <?php 
                        $i++;
                        endforeach; 
                        ?>
                    </ul>
                </form>


            </div>
            <div class="col-4">
            <div class="col-4">
    <div class="row">
        <div class="col">
            <div id="timer"><?php echo $duration; ?></div>
            <h3>Select Question:</h3>
            <div class="btn-group" role="group">
                <?php 
                for ($j = 1; $j <= count($questions); $j++):
                ?>
                    <button type="button" class="btn btn-primary rounded question-button" data-question="<?php echo $j; ?>"><?php echo $j; ?></button>
                <?php 
                endfor; 
                ?>
            </div>
            <div style="padding-top:50px;justify-content:center;align-items:center;text-align:center;">
                <button type="button" class="btn btn-primary" id="submitExamBtn" disabled>Submit Exam</button>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
    <br><br>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- Include SweetAlert library -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        // Function to enter full screen
        function enterFullscreen() {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) { /* Firefox */
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) { /* IE/Edge */
                document.documentElement.msRequestFullscreen();
            }
        }

        // Function to exit full screen
        function exitFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }
        }

        // Function to handle key press events
        function handleKeyPress(event) {
            if (event.key === "Escape") {
                exitFullscreen();
            }
        }

        // Add event listener to the document to toggle fullscreen on click
        document.addEventListener('click', function() {
            enterFullscreen();
            document.addEventListener('keydown', handleKeyPress); // Add keydown event listener
        });
    </script>
 
    
    
    
    <script>
    // Get the timer element
    var timerElement = document.getElementById('timer');
    // Get the submit exam button
    var submitExamButton = document.getElementById('submitExamBtn');

    // Function to enable/disable submit button based on timer
    function checkTimer() {
        var timeRemaining = parseTimeToSeconds(timerElement.textContent);

        // Enable submit button if there are 5 minutes or less remaining
        if (timeRemaining <= 300) { // 5 minutes = 300 seconds
            submitExamButton.disabled = false;
        } else {
            submitExamButton.disabled = true;
        }
    }

    // Check timer every second
    setInterval(checkTimer, 1000);

    // Function to convert time format (hh:mm:ss) to seconds
    function parseTimeToSeconds(time) {
        const timeParts = time.split(':');
        const hours = parseInt(timeParts[0], 10);
        const minutes = parseInt(timeParts[1], 10);
        const seconds = parseInt(timeParts[2], 10);

        return hours * 3600 + minutes * 60 + seconds;
    }

    document.querySelector('.question').style.display = 'block';
    document.querySelector('.question-button[data-question="1"]').classList.add('active');

    const saveNextButtons = document.querySelectorAll('.save-next-button');
    saveNextButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            const currentQuestionNumber = document.querySelector('.question-button.active').getAttribute('data-question');
            const currentQuestion = document.getElementById(`question-${currentQuestionNumber}`);
            let nextQuestionNumber, nextQuestion;

            if (index + 1 === saveNextButtons.length) {
                nextQuestionNumber = 1; // Loop back to the first question
            } else {
                nextQuestionNumber = index + 2;
            }
            nextQuestion = document.getElementById(`question-${nextQuestionNumber}`);

            if (currentQuestion && nextQuestion) {
                currentQuestion.style.display = 'none';
                nextQuestion.style.display = 'block';
            }

            document.querySelector(`.question-button[data-question="${currentQuestionNumber}"]`).classList.remove('active');
            document.querySelector(`.question-button[data-question="${nextQuestionNumber}"]`).classList.add('active');

            const selectedRadio = currentQuestion.querySelector('input[type="radio"]:checked');
            if (selectedRadio) {
                document.querySelector(`.question-button[data-question="${currentQuestionNumber}"]`).classList.remove('unanswered');
                document.querySelector(`.question-button[data-question="${currentQuestionNumber}"]`).classList.add('answered');
            } else {
                document.querySelector(`.question-button[data-question="${currentQuestionNumber}"]`).classList.add('unanswered');
            }
        });
    });

    document.querySelectorAll('.question-button').forEach(button => {
        button.addEventListener('click', () => {
            const currentQuestionNumber = document.querySelector('.question-button.active').getAttribute('data-question');
            const currentQuestion = document.getElementById(`question-${currentQuestionNumber}`);
            const nextQuestionNumber = button.getAttribute('data-question');
            const nextQuestion = document.getElementById(`question-${nextQuestionNumber}`);

            const selectedRadio = currentQuestion.querySelector('input[type="radio"]:checked');
            if (selectedRadio === null) {
                document.querySelector(`.question-button[data-question="${currentQuestionNumber}"]`).classList.add('unanswered');
            }

            document.querySelectorAll('.question').forEach(question => {
                question.style.display = 'none';
            });
            if (nextQuestion) {
                nextQuestion.style.display = 'block';
            }
            document.querySelectorAll('.question-button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });

    const timerDisplay = document.getElementById('timer');
    let timerSeconds = parseTimeToSeconds('<?php echo $duration; ?>');

    let alertShown = false; // Flag to track if alert has been shown

    function countdown() {
        const hours = Math.floor(timerSeconds / 3600);
        const minutes = Math.floor((timerSeconds % 3600) / 60);
        const seconds = timerSeconds % 60;

        timerDisplay.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        if (timerSeconds <= 600 && timerSeconds > 0 && !alertShown) {
            // Display SweetAlert when time is less than or equal to 10 minutes and alert hasn't been shown yet
            swal("Attention", "You have only 10 minutes remaining!", "info");
            alertShown = true; // Set flag to true to indicate alert has been shown
        }

        if (timerSeconds <= 300) { // 5 minutes = 300 seconds
            submitExamButton.disabled = false;
        } else {
            submitExamButton.disabled = true;
        }

        if (timerSeconds > 0) {
            timerSeconds--;
        } else {
            clearInterval(timerInterval);
            alert('Time up!');
            // You can add code here to handle what happens when the time is up
        }
    }

    const timerInterval = setInterval(countdown, 1000);

    // Attach event listener to submit exam button
    submitExamButton.addEventListener('click', function() {
        // Display success SweetAlert
        swal("Success", "You have submitted the exam successfully!", "success");
        // Here you can add any additional actions you want to perform after submitting the exam
    });
</script>



</body>
</html>
