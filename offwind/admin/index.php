<?php include('partials/navbar.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>

            <br><br>
            
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>

            <br><br>

            <div class="col-4 text-center">

                <?php 
                    // count groups from database
                    $sql = "SELECT * FROM tbl_group";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>

                <h1><?php echo $count; ?></h1>
                <br />
                Groups
            </div>

            <div class="col-4 text-center">

                <?php 
                    // count albums from database 
                    $sql2 = "SELECT * FROM tbl_album";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                ?>

                <h1><?php echo $count2; ?></h1>
                <br />
                Albums
            </div>

            <div class="col-4 text-center">
                    
                <?php 
                    // count orders from database 
                    $sql3 = "SELECT * FROM tbl_order";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);
                ?>

                <h1><?php echo $count3; ?></h1>
                <br />
                Total Orders
            </div>

            <div class="col-4 text-center">
                    
                <?php 
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                    $res4 = mysqli_query($conn, $sql4);
                    $row4 = mysqli_fetch_assoc($res4);
                    $total_revenue = $row4['Total'];
                ?>

                <h1>$<?php echo $total_revenue; ?></h1>
                <br />
                Revenue Generated
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

<?php include('partials/footer.php') ?>