<?php 
    // start session
    session_start();

    // store non-repeating values
    define('SITEURL', 'http://localhost/INF_653_Final/offwind/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'offwind');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // selecting database
?>