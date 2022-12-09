<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OffWind</title>

        <link rel="stylesheet" href="css/style.css? v=<?php echo time(); ?>">
    </head>

    <body>
        <section class="navbar">
            <div class="container">
                <div class="logo">
                    <a href="<?php echo SITEURL; ?>" class="logo">Off<span>Wind</span></a>
                </div>

                <div class="navbar text-right">
                    <ul>
                        <li>
                            <a href="<?php echo SITEURL; ?>">Home</a>
                        </li>

                        <li>
                            <a href="<?php echo SITEURL; ?>group.php">Groups</a>
                        </li>

                        <li>
                            <a href="<?php echo SITEURL; ?>album.php">Albums</a>
                        </li>

                        <li>
                            <a href="<?php echo SITEURL; ?>admin/login.php">Login</a>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </section>
