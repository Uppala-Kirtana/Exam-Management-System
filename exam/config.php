<?php
$server="localhost";
$username="root";
$password="";
$database="exam";
$conn = new mysqli ($server,$username,$password,$database);

if($conn !=""){
    // echo "connection success";
    echo "";
} else{
    echo "connection error";
}

?>