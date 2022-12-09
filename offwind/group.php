
<?php include('partials-front/navbar.php'); ?>

    <section class="categories">
        <div class="container album-menu">
            <h2 class="text-center">Groups</h2>

            <?php 
                $sql = "SELECT * FROM tbl_group WHERE active='Yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>group-album.php?group_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not found.</div>";
                                    }
                                    else
                                    {
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/group/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        
                                        <?php
                                    }
                                ?>
                                
                                <h3 class="float-text text-white"><span class="strokeme"><?php echo $title; ?></span></h3>
                            </div>
                        </a>

            <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Group not found.</div>";
                }
            ?>
            
            <div class="clearfix"></div>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>