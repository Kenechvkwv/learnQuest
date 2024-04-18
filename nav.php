<?php
session_start();
if (isset($_SESSION['email'])) {
    $style = "display:none;";
    $stylez = ""; // Show Dashboard
} else {
    $style = ""; // Show Login and SignUp
    $stylez = "display:none;";
}
?>
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
    <a href="index" class="navbar-brand d-flex align-items-center">
        <h2 class="m-0 text-primary">LearnQuest</h2>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-4 py-lg-0">
            <a href="index" class="nav-item nav-link <?php if (strpos($_SERVER['REQUEST_URI'], 'index') !== false) echo 'active'; ?>">Home</a>
            <a href="about" class="nav-item nav-link <?php if (strpos($_SERVER['REQUEST_URI'], 'about') !== false) echo 'active'; ?>">About</a>
            <!-- <a href="index#service" class="nav-item nav-link <?php if (strpos($_SERVER['REQUEST_URI'], 'service') !== false) echo 'active'; ?>">Service</a>
            <a href="plans" class="nav-item nav-link <?php if (strpos($_SERVER['REQUEST_URI'], 'plans') !== false) echo 'active'; ?>">Investment Plans</a>
            <a href="faq" class="nav-item nav-link <?php if (strpos($_SERVER['REQUEST_URI'], 'faq') !== false) echo 'active'; ?>">FAQ</a> -->
            <a href="contact" class="nav-item nav-link <?php if (strpos($_SERVER['REQUEST_URI'], 'contact') !== false) echo 'active'; ?>">Contact</a>
            <a href="user/index" class="nav-item nav-link" style="<?php echo $stylez; ?>">Dashboard</a>
            <a href="login" class="nav-item nav-link" style="<?php echo $style; ?><?php if (strpos($_SERVER['REQUEST_URI'], 'login') !== false) echo 'active'; ?>">Login</a>
            <a href="signup" class="nav-item nav-link" style="<?php echo $style; ?><?php if (strpos($_SERVER['REQUEST_URI'], 'signup') !== false) echo 'active'; ?>">SignUp</a>
        </div>
        <div class="h-100 d-lg-inline-flex align-items-center d-none">
            <a class="btn btn-square rounded-circle bg-light text-primary me-2" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-square rounded-circle bg-light text-primary me-2" href=""><i class="fab fa-twitter"></i></a>
            <a class="btn btn-square rounded-circle bg-light text-primary me-0" href=""><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
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
    <!--End of Tawk.to Script-->
</nav>