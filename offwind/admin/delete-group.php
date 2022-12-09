<?php 
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/group/".$image_name;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='error'>Unable to remove image</div>";
                header('location:'.SITEURL.'admin/manage-group.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_group WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Group Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-group.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Unable to delete group</div>";
            header('location:'.SITEURL.'admin/manage-group.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-group.php');
    }
?>