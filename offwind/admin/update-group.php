<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Group</h1>

        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_group WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    $_SESSION['no-group-found'] = "<div class='error'>Group not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-group.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-group.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>

                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>

                    <td>

                        <?php 
                            if($current_image != "")
                            {
                                ?>

                                <img src="<?php echo SITEURL; ?>images/group/<?php echo $current_image; ?>" width="150px">
                                
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image Not Added.</div>";
                            }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>

                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>

                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Group" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "")
                    {
                        $ext = end(explode('.', $image_name));
                        $image_name = $title."_".rand(000, 999).'.'.$ext; 
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/group/".$image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Unable to upload image</div>";
                            header('location:'.SITEURL.'admin/manage-group.php');
                            die();
                        }

                        if($current_image!="")
                        {
                            $remove_path = "../images/group/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                $_SESSION['failed-remove'] = "<div class='error'>Unable to remove current image</div>";
                                header('location:'.SITEURL.'admin/manage-group.php');
                            }
                        }
                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                $sql2 = "UPDATE tbl_group SET 
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active' 
                        WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Group Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-group.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Unable to update group</div>";
                    header('location:'.SITEURL.'admin/manage-group.php');
                }
            }

        ?>
        
    </div>
</div>

<?php include('partials/footer.php'); ?>