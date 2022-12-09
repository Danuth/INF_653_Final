
<?php include('partials-front/navbar.php'); ?>

    <section class="album-search text-center">
        <div class="container">
            <?php 
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>

            <h2>Albums on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
        </div>
    </section>

    <section class="album-menu">
        <div class="container">
            <h2 class="text-center">Album list</h2>
            <?php 
                $sql = "SELECT * FROM tbl_album WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
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
                                <h4><span class="strokeme"><?php echo $title; ?></span></h4>
                                <p class="album-price">$<?php echo $price; ?></p>

                                <p class="album-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

            <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Album not found.</div>";
                }
            
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>