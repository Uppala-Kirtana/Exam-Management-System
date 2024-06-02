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

if($_SESSION['mainid']){
    if (isset($_POST['cu'])) {
        header("location:createuser.php");
    }

    if (isset($_POST['ce'])) {
        header("location:ce.php");
    }

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    $deleteqry = mysqli_query($conn, "UPDATE e_login SET status='0' WHERE u_id='$delete_id'") or die(mysqli_error($conn));
  
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
        <div class="row">
            <div class="col" style="text-align: center;justify-content: center; align-items: center;">
                <form action="" method="post">
                        <input type="submit" class="btn btn-dark" id="cu" name="cu" value="Create User" />
                        <input type="submit" class="btn btn-success" id="ce" name="ce" value="Create exam" />
                        <br><br>
    </form>
    <div class="table-responsive">

                        <table class="table table-bordered" style="text-align:center;">
                            <tr>
                                <th>S.No</th>
                                <th>User ID</th>
                                <th>User Password</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>User Number</th>
                                <th>User DoB</th>
                                <th>User Gender</th>
                                <th>Delete</th>
                            </tr>

                            <?php
                            
                            $getdata = mysqli_query($conn,"SELECT u_id,pass,name,email,number,dob,gender FROM e_login WHERE status='1' AND id>1") or die(mysqli_error($conn));
                            if (!$getdata) {
                                die('Invalid query: ' . mysqli_error($conn));
                            }
                            $i = 1;

                            while ($getvalues = mysqli_fetch_object($getdata)) {
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $getvalues->u_id;?></td>
                                    <td><?php echo $getvalues->pass;?></td>
                                    <td><?php echo $getvalues->name;?></td>
                                    <td><?php echo $getvalues->email;?></td>
                                    <td><?php echo $getvalues->number;?></td>
                                    <td><?php echo $getvalues->dob;?></td>
                                    <td><?php echo $getvalues->gender;?></td>
                                    <td>
                                        <form id="deleteForm_<?php echo $getvalues->u_id;?>" method="post" action="">
                                            <input type="hidden" name="delete_id" value="<?php echo $getvalues->u_id;?>">
                                            <input type="submit" class="btn btn-danger delete-btn" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </table>   
                        </div>          
            </div>
        </div>
    </div><br><br>

    <script>
        document.querySelectorAll('.delete-btn').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const formId = event.target.closest('form').getAttribute('id');
                document.getElementById(formId).submit();
            });
        });
    </script>

</body>
</html>
