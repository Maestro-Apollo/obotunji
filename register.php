<?php
session_start();





include('class/database.php');
class signInUp extends database
{
    protected $link;

    public function matchingFunction()
    {
        if (isset($_POST['submit'])) {
            $fname = addslashes(trim($_POST['fname']));
            $lname = addslashes(trim($_POST['lname']));
            $email = addslashes(trim($_POST['email']));
            $code = addslashes(trim($_POST['code']));

            $sql = "SELECT * from code_tbl where code = '$code'";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {

                $row = mysqli_fetch_assoc($res);
                $url = 'https://app.portal.vivomeetings.com/sign-up?product=vivomeetings_free_trial';
                $status = $row['status'];
                $id = $row = $row['code_id'];

                if ($status == 'Not Used') {

                    $sqlUpdate = "UPDATE code_tbl SET `status` = 'Used' WHERE `code_id` = $id";
                    $resUpdate = mysqli_query($this->link, $sqlUpdate);

                    if ($resUpdate) {
                        $sqlInsert = "INSERT INTO `user_tbl` (`user_id`, `fname`, `lname`, `email`, `code_id`) VALUES (NULL, '$fname', '$lname', '$email', $id)";
                        $resInsert = mysqli_query($this->link, $sqlInsert);

                        if ($resInsert) {

                            $to = 'redemption@vivomeetings.com';
                            $subject = 'Redeem Code Status';
                            $from = 'info@promovivomeetings.com';

                            $headers  = "From: " . $from . "\n";
                            $headers .= "Cc: " . $from . "\n";
                            $headers .= "X-Sender: " . $from . "\n";
                            $headers .= 'X-Mailer: PHP/' . phpversion();
                            $headers .= "X-Priority: 1\n"; // Urgent message!
                            $headers .= "Return-Path: " . $from . "\n"; // Return path for errors
                            $headers .= "MIME-Version: 1.0\r\n";
                            $headers .= "Content-Type: text/html; charset=iso-8859-1\n";

                            $message = '';
                            $message .= 'First Name: ' . $fname . "\r\n" . '<br>';
                            $message .= 'Last Name: ' . $lname . "\r\n" . '<br>';
                            $message .= 'Email: ' . $email . "\r\n" . '<br>';
                            $message .= 'Code: ' . $code . "\r\n" . '<br>';

                            if (mail($to, $subject, $message, $headers)) {
                                header('Location:' . $url);
                            }
                        }
                    }
                } else {
                    return 'code already used';
                }
            } else {
                return 'code not valid ';
            }
        }
    }
}
$obj = new signInUp;
$objSignIn = $obj->matchingFunction();

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
        font-family: 'Lato', sans-serif;
    }

    .navbar-brand {
        width: 10%;
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

                        <div class="pt-3">
                            <p>

                                Please share your name, email, and purchase code to get subscribed. After your
                                submission, you will be redirected to sign up for a free trial Vivomeetings account.
                                The
                                free account would be converted to what you paid for within 24 to 48 hours.
                                <br><br>

                                If you have any questions or issues with redemption, please email our team
                                redemption@vivomeetings.com
                                <br><br>

                                Thanks so much and happy to have you.
                                <br><br>

                                Maria Dawson
                            </p>


                        </div>
                        <input type="text" name="fname" class="form-control p-4  bg-light" placeholder="First Name"
                            required>
                        <input type="text" class="form-control mt-4 p-4 bg-light" name="lname" placeholder="Last Name"
                            required>
                        <input type="email" class="form-control mt-4 p-4 bg-light" name="email" placeholder="Email"
                            required>
                        <input type="text" minlength="38" maxlength="38" class="form-control mt-4 p-4 bg-light"
                            name="code" placeholder="Redeem Code" required>


                        <button type="submit" name="submit"
                            class="btn btn-block font-weight-bold log_btn btn-lg mt-4">Yes Let Me In</button>

                        <?php if (isset($objSignIn)) { ?>
                        <div class="alert alert-warning alert-dismissible mt-3">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><?php echo $objSignIn ?></strong>
                        </div>
                        <?php } ?>

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