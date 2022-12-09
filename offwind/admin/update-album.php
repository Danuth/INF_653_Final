<?php include('partials/navbar.php'); ?>

<?php 
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM tbl_album WHERE id=$id";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);

        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_group = $row2['group_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-album.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update album</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>

                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>

                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>

                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>

                    <td>

                        <?php 
                            if($current_image == "")
                            {
                                //Image not Available 
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/album/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                        ?>

                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>

                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Group: </td>

                    <td>
                        <select name="group">

                            <?php 
                                $sql = "SELECT * FROM tbl_group WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $group_name = $row['title'];
                                        $group_id = $row['id'];
                                        
                                        ?>

                                        <option <?php if($current_group==$group_id){echo "selected";} ?> value="<?php echo $group_id; ?>"><?php echo $group_name; ?></option>
                                        
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<option value='0'>Group Not Available.</option>";
                                }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>

                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>

                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Album" class="btn-secondary">
                    </td>
                </tr>
            </table>   
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $group = $_POST['group'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name']; 

                    if($image_name!="")
                    {
                        $image_info = explode (".", $image_name);
                        $ext = end ($image_info);
                        $image_name = $group."_album_".rand(000, 999).'.'.$ext;
                        $src_path = $_FILES['image']['tmp_name']; 
                        $dest_path = "../images/album/".$image_name; 
                        $upload = move_uploaded_file($src_path, $dest_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Unable to upload image</div>";
                            header('location:'.SITEURL.'admin/manage-album.php');
                            die();
                        }

                        if($current_image!="")
                        {
                            $remove_path = "../images/album/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                $_SESSION['remove-failed'] = "<div class='error'>Unable to remove image</div>";
                                header('location:'.SITEURL.'admin/manage-album.php');
                                die();
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

                $sql3 = "UPDATE tbl_album SET 
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        group_id = '$group',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id";
                $res3 = mysqli_query($conn, $sql3);

                if($res3==true)
                {
                    $_SESSION['update'] = "<div class='success'>Album Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-album.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Unable to update album</div>";
                    header('location:'.SITEURL.'admin/manage-album.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>