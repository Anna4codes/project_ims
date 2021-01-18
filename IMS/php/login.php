<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    $userEmail = $_POST['inputEmail']; //grabbing the user input for the email
    $userPass = $_POST['inputPassword']; //grabbing the user input for the password


    $con = mysqli_connect("localhost","root","","inventory");//mysqli("localhost","username of database","password of database","database name") establishing a connection
    $inputCheck = mysqli_query($con,"SELECT * FROM `user_list` WHERE `USER_ID`='$userEmail' && `USER_PASS`='$userPass'"); //query to grab and compare the user input and the data in the database

    $outPut = mysqli_num_rows($inputCheck); //listing the results hit in the database after the comparison

    if($outPut==1)
    {

        $_SESSION['log'] = 1;
        header("location:../dashboard.php");
        $sql = "INSERT INTO user_log(USER_ID) VALUES ('$userEmail')";
        $query = mysqli_query($con,$sql);
         $_SESSION['deptRow'] = 'Hardware Component';

    }


    else
    {
        echo "please fill proper details";
         die(header("location:../index.php?loginFailed=1"));


    }
} else
    {
        echo 'no user details entered';
    }

?>


