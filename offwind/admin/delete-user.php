<?php 
    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>User Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-user.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Unable to delete user</div>";
        header('location:'.SITEURL.'admin/manage-user.php');
    }
?>