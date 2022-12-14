<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add User</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']);
            }
        ?>

        <br><br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>

                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>

                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>

                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add User" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];
                $password = md5($_POST['password']); 

                $sql = "INSERT INTO tbl_admin SET 
                        full_name='$full_name',
                        username='$username',
                        password='$password'";
                $res = mysqli_query($conn, $sql) or die(mysqli_error());

                if($res==TRUE)
                {
                    $_SESSION['add'] = "<div class='success'>User Added Successfully.</div>";
                    header("location:".SITEURL.'admin/manage-user.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Unable to add user</div>";
                    header("location:".SITEURL.'admin/add-user.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>


