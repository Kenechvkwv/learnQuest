<?php
function fullname()
{
    require '../dbconn.php';


    $email = $_SESSION['email'];
    $sql = "SELECT fullname FROM fidelitytable WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['fullname'];
        }
    };
};

function calculateAge($birthdate)
{
    $today = new DateTime();
    $diff = $today->diff(new DateTime($birthdate));
    return $diff->y;
}

function age()
{
    require '../dbconn.php';

    $email = $_SESSION['email'];
    $sql = "SELECT dob FROM fidelitytable WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $birthdate = $row['dob'];
            $age = calculateAge($birthdate);

            echo $age;
        }
    }
}

function dob()
{
    require '../dbconn.php';

    $email = $_SESSION['email'];
    $sql = "SELECT dob FROM fidelitytable WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $birthdate = $row['dob'];

            echo $birthdate;
        }
    }
}

function address()
{
    require '../dbconn.php';


    $email = $_SESSION['email'];
    $sql = "SELECT address FROM fidelitytable WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['address'];
        }
    };
};
