<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Group</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Group Name: </td>

                    <td>
                        <input type="text" name="title" placeholder="Enter group name...">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>

                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>

                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>

                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Group" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                if(isset($_FILES['image']['name']))
                {
                    // upload image
                    $image_name = $_FILES['image']['name'];
                    
                    if($image_name != "")
                    {
                        $image_info = explode (".", $image_name);
                        $ext = end ($image_info);
                        $image_name = $title."_".rand(000, 999).'.'.$ext;        
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/group/".$image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Unable to upload image</div>";
                            header('location:'.SITEURL.'admin/add-group.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name="";
                }

                $sql = "INSERT INTO tbl_group SET 
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'";
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    $_SESSION['add'] = "<div class='success'>Group Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-group.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Unable to add group</div>";
                    header('location:'.SITEURL.'admin/add-group.php');
                }
            }       
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>