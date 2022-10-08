<?php
session_start();

include('class/database.php');
class signInUp extends database
{
    protected $link;

    public function signInFunction()
    {
        if (isset($_POST['signIn'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "select * from admin where admin_username = '$username' ";
            $res = mysqli_query($this->link, $sql);

            $sql2 = "SELECT * from employee_tbl where employee_username = '$username' ";
            $res2 = mysqli_query($this->link, $sql2);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $pass = $row['admin_password'];

                if ($password == $pass) {
                    $_SESSION['admin'] = $username;
                    header('location:index.php');
                    return $res;
                } else {
                    $msg = "Wrong password";
                    return $msg;
                }
            } else if (mysqli_num_rows($res2) > 0) {
                $row = mysqli_fetch_assoc($res2);
                $pass = $row['employee_password'];

                if ($password == $pass) {
                    $_SESSION['name'] = $username;
                    header('location:inventory-list.php');
                    return $res;
                } else {
                    $msg = "Wrong password";
                    return $msg;
                }
            } else {
                $msg = "Invalid Information";
                return $msg;
            }
        }
        # code...
    }
}
$obj = new signInUp;
$objSignIn = $obj->signInFunction();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>
    <style>
    body {
        font-family: 'Raleway', sans-serif;
    }

    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>

    <section>
        <div class="container bg-white pr-4 pl-4  log_section pb-5">

            <div class="row">
                <div class="col-md-6 offset-3 ">
                    <form action="" method="post" data-parsley-validate>

                        <div class="text-center">
                            <h4 class="font-weight-bold pt-5 pb-4">LOGIN</h4>

                            <?php if ($objSignIn) { ?>
                            <?php if (strcmp($objSignIn, 'Wrong password') == 0) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Wrong Password!</strong>
                            </div>
                            <?php } ?>
                            <?php if (strcmp($objSignIn, 'Invalid Information') == 0) { ?>
                            <div class="alert alert-warning alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Please Sign Up!</strong>
                            </div>
                            <?php } ?>

                            <?php } ?>
                        </div>
                        <input type="text" name="username" class="form-control p-4  border-0 bg-light"
                            placeholder="Enter your Username" required>
                        <input type="password" class="form-control mt-4 p-4 border-0 bg-light" name="password"
                            placeholder="Enter your password" required>


                        <button type="submit" name="signIn"
                            class="btn btn-block font-weight-bold log_btn btn-lg mt-4">LOGIN</button>
                        <!-- <small class="font-weight-bold mt-1 text-muted"><a href="forget_password.php"
                                style="color: #05445E;">Forget
                                Password</a></small> -->
                        <!-- <hr>
                        <small class="font-weight-bold mt-1 text-muted">Don't have an account? <a href="register.php"
                                style="color: #05445E;">Forget Password</a></small> -->

                    </form>
                </div>

                <!-- <form action="" method="post"> -->

                <!-- </form> -->
            </div>

        </div>

    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
</body>

</html>