<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Album</h1>

        <br><br>

        <?php 
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
                    <td>Title: </td>

                    <td>
                        <input type="text" name="title" placeholder="Enter album...">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>

                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the album." ></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>

                    <td>
                        <input type="number" name="price" step=".01">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>

                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Group Name: </td>

                    <td>
                        <select name="group">

                            <?php 
                                // display groups from database
                                // create SQL to get all groups from database
                                $sql = "SELECT * FROM tbl_group WHERE active='Yes'";
                                
                                // executing qury
                                $res = mysqli_query($conn, $sql);

                                // count rows to check whether we have groups or not
                                $count = mysqli_num_rows($res);

                                //  if count is greater than zero, contain groups else don't
                                if($count>0)
                                {
                                    // contain groups
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of groups
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    // don't contain groups
                                    ?>
                                    <option value="0">No Group Found</option>
                                    <?php
                                }
                            

                                // display on dropdown
                            ?>

                        </select>
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
                        <input type="submit" name="submit" value="Add Album" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php 
            if(isset($_POST['submit']))
            {
                // insert album into database
                // get inputs from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $group = $_POST['group'];

                // check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; // setting default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; // setting default value
                }

                // upload image
                if(isset($_FILES['image']['name']))
                {
                    // get details of the selected image
                    $image_name = $_FILES['image']['name'];

                    if($image_name!="")
                    {
                        // rename the image
                        // gt the extension of selected image (jpg, png, gif, etc.) 
                        $image_info = explode (".", $image_name);
                        $ext = end ($image_info);
                        // generate new name for image
                        $image_name = $group."_album_".rand(000, 999).'.'.$ext;

                        // upload image
                        // get source path and destination path
                        // source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];
                        // destination path for the image to be uploaded
                        $dst = "../images/album/".$image_name;
                        $upload = move_uploaded_file($src, $dst);

                        if($upload == false)
                        {
                            // failed to upload image
                            $_SESSION['upload'] = "<div class='error'>Unable to upload image</div>";
                            header('location:'.SITEURL.'admin/add-album.php');
                            // stop the process
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = ""; // setting default value
                }

                // insert into database
                $sql2 = "INSERT INTO tbl_album SET 
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        group_id = $group,
                        featured = '$featured',
                        active = '$active'";
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    $_SESSION['add'] = "<div class='success'>Album Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-album.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Unable to add album</div>";
                    header('location:'.SITEURL.'admin/manage-album.php');
                }                
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>