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
    <h1 class="display-4" style="color: aliceblue;font-family: 'Times New Roman', Times, serif;">TestMate Exam Portal</h1><br>
        <h6  style="color: rgb(137, 195, 194);"><i>Unlock your potential, one question at a time</i></h6><br>
        
    </div><br><br><br>

        <div class="container text-center" style="border: 2px solid black; background-color: white;width: fit-content;padding: 50px;">
            <div class="row">

                <div class="col" style="text-align: center;justify-content: center; align-items: center; display: flex;">
                    <form action="" method="post">
                        <label for="">
                            <h3 style="font-family: 'Times New Roman', Times, serif;">Enter User ID</h3>
                        </label>
                        <input type="text" class="form-control" id="l1" name="l1" placeholder="Enter User ID" aria-label="Username" aria-describedby="basic-addon1" /><br>
                        
                        <label for="">
                        <h3 style="font-family: 'Times New Roman', Times, serif;">Enter Password</h3>
                        </label>
                        <div style="position: relative;">
                            <input type="password" class="form-control" id="l2" name="l2" placeholder="Enter Password" aria-label="Username" aria-describedby="basic-addon1" />
                            <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                <i class="bi bi-eye-slash"></i>
                            </span>

                        </div>

                        <br>
                        <input type="submit" class="btn btn-dark" id="login" name="login" value="Submit" />
                    </form>
                    
                </div>

            </div>
        </div><br><br>

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
require_once "config.php";

if(isset($_POST['login'])){
    $uid = $_POST['l1'];
    $pass = $_POST['l2'];
    $qry = mysqli_query($conn, "SELECT id,u_id FROM e_login WHERE status='1' AND BINARY u_id='$uid' AND BINARY pass='$pass'") or die(mysqli_error($conn));

    if(mysqli_num_rows($qry) > 0) {
        $res = mysqli_fetch_object($qry);
        $mainid = $res->id;  
        session_start();
        $_SESSION['mainid'] = $mainid;
        $mainid = $_SESSION['mainid'];
        if ($mainid == 1) {
            header("location: adminmp.php"); // Redirect to adminmp page
        } else {
            header("location: usermp.php"); // Redirect to usermp page
        }
    } else {
        echo 'Swal.fire({
                icon: "error",
                title: "Incorrect Username or Password",
                text: "Please try again."
            });';
    }
}
?>

</script>
    
</body>
</html>
