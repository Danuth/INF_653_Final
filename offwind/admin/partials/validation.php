<?php 
    // authorization - Access COntrol
    if(!isset($_SESSION['user'])) // if user session is not set
    {
        // user is not logged in
        // redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access</div>";
        // redirect to Login Page
        header('location:'.SITEURL.'admin/login.php');
    }
?>