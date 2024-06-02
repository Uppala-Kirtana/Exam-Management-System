<?php
require_once "config.php";

session_start();
$mainid = $_SESSION['mainid'];

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['mainid'])) {
    header("location: login.php"); // Redirect to login page if user is not logged in
    exit(); // Stop further execution
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
        <h1>Enter New User Details</h1><br>
        <form id="registrationForm" method="post" action="">

        <div class="mb-3 row">
    <label for="userid" class="col-sm-3 col-form-label">User ID:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="userid" name="userid">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="password" class="col-sm-3 col-form-label">Password:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="password" name="password">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="firstName" class="col-sm-3 col-form-label">Name:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="name" name="name">
    </div>
</div>


  <div class="mb-3 row">
    <label for="email" class="col-sm-3 col-form-label">Email:</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="email" name="email">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="mobile" class="col-sm-3 col-form-label">Mobile Number:</label>
    <div class="col-sm-9">
    <input type="number" class="form-control" id="mobile" name="mobile" maxlength="10">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="dob" class="col-sm-3 col-form-label">Date of Birth:</label>
    <div class="col-sm-9">
      <input type="date" class="form-control" id="dob" name="dob">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="gender" class="col-sm-3 col-form-label">Gender:</label>
    <div class="col-sm-9">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
        <label class="form-check-label" for="male">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
        <label class="form-check-label" for="female">Female</label>
      </div>
    </div>
  </div>

  <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Submit" />
  <input type="button" class="btn btn-dark" id="back" name="back" value="Go Back" />

</form>
      </div><br><br>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
//   function validateUserID(inputId, fieldName) {
//     var userInput = document.getElementById(inputId);
//     var userID = userInput.value.trim();
//     var regex = /^US\d+$/; // Regular expression to match "US" followed by one or more digits

//     if (!regex.test(userID)) {
//         Swal.fire({
//             icon: 'error',
//             title: 'Invalid input',
//             text: 'Please enter a valid ' + fieldName + ' in the format US followed by digits.'
//         });
//         return false;
//     }

//     return true;
// }

function validateUserID() {
    var useridInput = document.getElementById("userid").value;
    var regex = /^US\d{2}$/; // US followed by exactly 2 digits

    if (!regex.test(useridInput)) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid input',
        text: 'User ID must be in the format US followed by two digits'
      });
        // alert("User ID must be in the format US followed by two digits (e.g., US01).");
        return false; // Prevent form submission
    }
    return true; // Proceed with form submission
}

  function validateName(inputId, fieldName) {
    var nameInput = document.getElementById(inputId);
    var nameValue = nameInput.value.trim();
    if (nameValue === '') {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Please enter ' + fieldName + '.'
      });
      return false;
    }
    if (!/^[a-zA-Z\s]+$/.test(nameValue)) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid input',
        text: 'Please enter a valid ' + fieldName + ' containing only letters.'
      });
      return false;
    }
    return true;
  }

  function checkEmptyFields() {
    var inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="number"], input[type="date"]');
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

  function validateMobileNumber() {
    var mobileInput = document.getElementById("mobile");
    var mobileNumber = mobileInput.value.trim();
    if (mobileNumber === '') {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Please enter a mobile number.'
      });
      return false;
    }
    if (!/^\d+$/.test(mobileNumber)) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid input',
        text: 'Mobile number should contain only digits.'
      });
      return false;
    }
    if (mobileNumber.length !== 10) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid input',
        text: 'Mobile number should have exactly 10 digits.'
      });
      return false;
    }
    return true;
  }

  document.getElementById("registrationForm").addEventListener("submit", function(event) {
    if (checkEmptyFields()) {
        event.preventDefault();
    } else {
        if ((!validateName("firstName", "first name") || !validateMobileNumber()) || !validateUserID()) {
            event.preventDefault();
        }
        // Add a check for validateUserID() here and prevent form submission if it returns false
    }
});


document.getElementById("back").addEventListener("click", function() {
    window.location.href = "adminmp.php"; 
});

</script>



<script>
  var input = document.querySelector("#mobile");


  var messageElement = document.createElement("div");
  messageElement.classList.add("error-message");
  input.parentNode.appendChild(messageElement);

  input.addEventListener('input', function(event) {
    var mobileNumber = input.value;
    if (!/^\+?\d*$/.test(mobileNumber)) {
      messageElement.textContent = 'Please enter a valid mobile number.';
      input.value = '';
    } else if (mobileNumber.length > 10) {
      input.value = input.value.slice(0, 10);
    } else {
      messageElement.textContent = '';
    }
  });
</script>

  <script>
    document.getElementById("dob").addEventListener("input", function() {
      var selectedDate = new Date(this.value);
      var today = new Date();
      if (selectedDate > today) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Please select a date in the past.'
        });
        this.value = '';
        return;
      }
      var age = today.getFullYear() - selectedDate.getFullYear();
      var monthDiff = today.getMonth() - selectedDate.getMonth();
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < selectedDate.getDate())) {
        age--;
      }
      document.getElementById("age").value = age + " years";
    });
  
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("dob").setAttribute("max", today);

  </script>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#l2');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.innerHTML = '';
        togglePassword.innerHTML = type === 'password' ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
    });
</script>

<script>
<?php
if(isset($_POST['submit'])){
    $uid=$_POST['userid'];
    $pass = $_POST['password'];
    $fn = $_POST['name']; // Update 'firstName' to 'name'
    $em = $_POST['email'];
    $mb = $_POST['mobile'];
    $db = $_POST['dob'];
    $g = $_POST['gender'];

    if ($g === 'Male') {
        $g = 'M';
    } elseif ($g === 'Female') {
        $g = 'F';
    }

    // Check if the uid exists
    $check_query = "SELECT * FROM e_login WHERE u_id = '$uid'";
    $result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($result) > 0) {
      echo 'Swal.fire({
        icon: "error",
        title: "User Exists",
        text: "Please try again."
    });';
    } else {
        // User does not exist, proceed with insertion
        $insert_query = "INSERT INTO e_login (u_id,pass, name, email, number, dob, gender) VALUES ('$uid','$pass', '$fn', '$em', '$mb', '$db', '$g')";

        if(mysqli_query($conn, $insert_query)) {
            header("location: adminmp.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>



</script>
    
</body>
</html>
