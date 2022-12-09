<?php 
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) 
    {
        // delete album
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove image if available
        if($image_name != "")
        {
            // get image path
            $path = "../images/album/".$image_name;
            // remove image file from the folder
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['upload'] = "<div class='error'>Unable to remove image</div>";
                header('location:'.SITEURL.'admin/manage-album.php');
                die();
            }
        }

        // delete album from database
        $sql = "DELETE FROM tbl_album WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Album Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-album.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Unable to delete album</div>";
            header('location:'.SITEURL.'admin/manage-album.php');
        }
    }
    else
    {
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-album.php');
    }

?>