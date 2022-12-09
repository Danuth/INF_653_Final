
<?php include('partials-front/navbar.php'); ?>

<?php 
    if(isset($_GET['album_id']))
    {
        $album_id = $_GET['album_id'];
        $sql = "SELECT * FROM tbl_album WHERE id=$album_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        header('location:'.SITEURL);
    }
?>

    <section class="album-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Album</legend>
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
                        <h3><span class="strokeme"><?php echo $title; ?></span></h3>
                        <input type="hidden" name="album" value="<?php echo $title; ?>">

                        <p class="album-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>" step=".01">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>

            <?php 
                if(isset($_POST['submit']))
                {
                    $album = $_POST['album'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty; 
                    $order_date = date("Y-m-d");
                    $status = "Ordered";  

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    $sql2 = "INSERT INTO tbl_order SET 
                            album = '$album',
                            price = $price,
                            qty = $qty,
                            total = $total,
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'";
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        $_SESSION['order'] = "<div class='success text-center'>Album Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='error text-center'>Unable to order album</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>