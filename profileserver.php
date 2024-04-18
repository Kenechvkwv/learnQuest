<?php

require 'dbconn.php';

session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: login");
}

$msg = "";


// If upload button is clicked ...
if (isset($_POST['submit'])) {
    // $fullname = mysqli_escape_string($db, $_POST['fullname']);
    // $phonenumber = mysqli_escape_string($db, $_POST['phonenumber']);
    // $country = mysqli_escape_string($db, $_POST['country']);
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;
    $sessionuser = $_SESSION['email'];


    // Get all the submitted data from the form
    // $sql = "INSERT INTO fidelitytable (filename) VALUES ('$filename')";
    $sql = "UPDATE fidelitytable SET filename='$filename' WHERE email = '$sessionuser' ";


    // Execute query
    mysqli_query($db, $sql);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Updated successfully!</h3>";
        echo "<div id='echothis'><p>Page will redirect back to dashboard in 5 seconds</p></div>";

        header("refresh:5;url=user/index");
    } else {
        echo "<h3>  Failed to Update</h3>";
        echo "<div id='echothis'><p>Page will redirect back to dashboard in 5 seconds</p></div>";

        header("refresh:5;url=user/index");
    }
}
