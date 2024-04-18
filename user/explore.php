<?php
require '../dbconn.php';
require 'function.php';

session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: ../login");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet " href="https://unpkg.com/boxicons@latest/css/boxicons.min.css ">
    <link rel="stylesheet " href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css ">
    <link rel="shortcut icon" href="../img/icon-1.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js "></script>

</head>

<body>
    <div class="container ">
        <div class="left_sidebar">
            <div class="close_hamburger_btn">
                <i class='bx bx-x-circle'></i>
            </div>
            <div class="logo ">
                <h2><a href="../index">LearnQuest</a></h2>
            </div>
            <div class="menu_items ">
                <div class="menu_item ">
                    <i class='bx bxs-dashboard'></i>
                    <a class="" href="index">Dashboard</a>
                </div>

                <div class="menu_item ">
                    <i class='bx bx-file-blank'></i>
                    <a href="#" class="active">Explore Courses</a>
                </div>

                <div class="menu_item ">
                    <i class='bx bx-cog'></i>
                    <a href="index?logout='1'">Logout</a>
                </div>
            </div>
        </div>
        <div class="main_content">
            <div class="left_right_sidebar_opener">
                <div class="hamburger">
                    <i class='bx bx-menu'></i>
                </div>
                <div class="student">

                    <div class="profile_img">
                        <?php
                        require '../dbconn.php';

                        $email = $_SESSION['email'];
                        $query = "SELECT filename FROM fidelitytable WHERE email='$email'";
                        $result = mysqli_query($db, $query);

                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                            <img src="../image/<?php echo $data['filename']; ?>" alt="studentImg " alt="profile img">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="profile_name">
                        <p><?php fullname() ?></p>
                    </div>

                </div>
            </div>
            <div class="main_navbar">
                <div class="search_box">
                    <input type="text " placeholder="Explore ">
                </div>
            </div>
            <div class="menu_item_name_and_filter ">

            </div>
            <div class="tabs">
                <div class="tab_name">
                    <p>Student</p>
                </div>
                <div class="three_dots">
                    <i class='bx bx-dots-vertical-rounded'></i>
                </div>
            </div>

            <!-- Embedding a course -->
            <iframe src="https://www.iiardjournals.org/" width="100%" height="600px" frameborder="0" allowfullscreen></iframe>


        </div>
        <div class="right_sidebar ">
            <div class="notification_and_name ">
                <div class="close_btn ">
                    <i class='bx bx-x-circle'></i>
                </div>
                <div class="bell ">
                    <i class='bx bx-bell'></i>
                    <span></span>
                </div>
                <?php
                require '../dbconn.php';

                $email = $_SESSION['email'];
                $query = "SELECT filename FROM fidelitytable WHERE email='$email'";
                $result = mysqli_query($db, $query);

                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <img src="../image/<?php echo $data['filename']; ?>" alt="studentImg " alt="profile img">
                <?php
                }
                ?>
                <p><?php fullname() ?> </p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="profile ">
                <div class="img ">
                    <?php
                    require '../dbconn.php';

                    $email = $_SESSION['email'];
                    $query = "SELECT filename FROM fidelitytable WHERE email='$email'";
                    $result = mysqli_query($db, $query);

                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                        <img src="../image/<?php echo $data['filename']; ?>" alt="studentImg ">
                    <?php
                    }
                    ?>
                    <form id="profilepicture" action="../profileserver.php" method="POST" enctype="multipart/form-data">>
                        <label for="uploadfile" class="hidden-label">Upload Image</label>
                        <input type="file" id="uploadfile" name="uploadfile" required style="display: none;">
                        <button type="submit" class="logoutBtn" name="submit">Click to upload</button>
                    </form>
                </div>
                <div class="name_and_class ">
                    <p><?php fullname() ?></p>
                    <span>Student</span>
                </div>
                <div class="contact_info ">
                    <div class="contact-info">
                        <a href="mailto:support@propellerssportsventures.com"><i class='bx bx-envelope'></i></a>
                        <a href="tel:+2347064252184"><i class='bx bx-phone-call'></i></a>
                        <a href="tel:+2347064252184"><i class='bx bx-message-rounded-dots'></i></a>
                    </div>

                </div>
                <div class="about">
                    <h4>About</h4>
                    <p>Welcome to your dashboard! Here at LearnQuest, we're committed to empowering you on your learning journey. Whether you're diving into coding, exploring new technologies, or enhancing your skills, we're here to support and guide you every step of the way. Let's learn, grow, and succeed together!</p>
                </div>

                <div class="other_info ">
                    <div class="age ">
                        <h4>Age</h4>
                        <p><?php age() ?></p>
                    </div>
                    <!-- <div class="gender ">
                        <h4>Gender</h4>
                        <p>Male</p>
                    </div> -->
                    <div class="dob ">
                        <h4>DOB</h4>
                        <p><?php dob() ?></p>
                    </div>
                    <div class="address ">
                        <h4>Address</h4>
                        <p><?php address() ?></p>
                    </div>
                </div>

            </div>
            <a href="index?logout='1'"></a>
            <span class="cont">

                <a class="log-btn" href="index?logout='1' "> <button class="logoutBtn">Log out</button></a>
        </div>
    </div>


    <script src="dashboard.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/661f89b61ec1082f04e36832/1hrlj3ss5';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>

</body>

</html>