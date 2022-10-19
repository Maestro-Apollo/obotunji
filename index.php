<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promovivo</title>
    <?php include('layout/style.php'); ?>
    <style>
    body {
        font-family: 'Lato', sans-serif;
    }

    .navbar-brand {
        width: 20%;
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

                    <form id="myForm" data-parsley-validate>

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

                        <div id="output2"></div>


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
    <script>
    $(document).ready(function() {

        $('#myForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "ajax-enter.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response == 1) {
                        window.location.href =
                            "https://app.portal.vivomeetings.com/sign-up?product=vivomeetings_free_trial"
                    } else {
                        $('#output2').fadeIn().html(response);

                    }
                }
            });
            this.reset();
        });
    })
    </script>
</body>

</html>