<?php include('partials-front/navbar.php'); ?>

<?php 
    if(isset($_GET['group_id']))
    {
        $group_id = $_GET['group_id'];
        $sql = "SELECT title FROM tbl_group WHERE id=$group_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $group_name = $row['title'];
    }
    else
    {
        header('location:'.SITEURL);
    }
?>

    <section class="album-search text-center">
        <div class="container">
            <h2>Albums from <a href="#" class="text-white">"<?php echo $group_name; ?>"</a></h2>
        </div>
    </section>

    <section class="album-menu">
        <div class="container">
            <h2 class="text-center">Album List</h2>

            <?php 
                $sql2 = "SELECT * FROM tbl_album WHERE group_id=$group_id";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        
                        <div class="album-menu-box">
                            <div class="album-menu-img">
                                <?php 
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/album/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="album-menu-desc">
                                <h4><?php echo $title; ?></h4>

                                <p class="album-price">$<?php echo $price; ?></p>
                                <p class="album-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?album_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

            <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Album not Available.</div>";
                }
            ?>
            <div class="clearfix"></div> 
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>