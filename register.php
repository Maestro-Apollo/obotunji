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
        <div class="container bg-white pr-4 pl-4 shadow log_section pb-5">

            <div class="row">
                <div class="col-md-6">
                    <form action="" method="post" data-parsley-validate>

                        <div class="text-justify">
                            <p class="font-weight-bold pt-5 pb-4">
                                Please share your name, email, and purchase code to
                                get subscribed.
                                After your submission, you will be redirected to sign up for a free trial Vivomeetings
                                account.
                                The free account would be converted to what you paid for within 24 to 48 hours.
                                If you have any questions or issues with redemption, <br>please email our team
                                <a href="mailto:redemption@vivomeetings.com">redemption@vivomeetings.com</a>
                                <br>Thanks so much and happy to have you.
                                <br><br>Maria Dawson
                            </p>


                        </div>
                        <input type="text" name="fname" class="form-control p-4  bg-light" placeholder="First Name"
                            required>
                        <input type="text" class="form-control mt-4 p-4 bg-light" name="lname" placeholder="Last Name"
                            required>
                        <input type="email" class="form-control mt-4 p-4 bg-light" name="email" placeholder="Email"
                            required>
                        <input type="number" minlength="38" class="form-control mt-4 p-4 bg-light" name="code"
                            placeholder="Redeem Code" required>


                        <button type="submit" name="signIn"
                            class="btn btn-block font-weight-bold log_btn btn-lg mt-4">Yes Let Me In</button>


                    </form>
                </div>
                <div class="col-md-6">
                    <img src="./images/1.png" alt="">
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