<?php
session_start();
if (isset($_SESSION['admin5'])) {
} else {
    header('location:login.php');
}

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
        font-family: 'Lato', sans-serif;
    }

    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }
    </style>
    <link rel="stylesheet" href="./css/parsley.css">
</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>

    <section>
        <div class="container bg-white p-4 pb-3 shadow log_section">

            <div class="text-center">
                <h3 class="font-weight-bold pt-3">
                    Admin Panel
                </h3>
                <p class="lead">Generate Code</p>

            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div id="output2"></div>

                    <form id="myForm" data-parsley-validate>


                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                value="STD" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                STD
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                value="LTD">
                            <label class="form-check-label" for="exampleRadios2">
                                LTD
                            </label>
                        </div>

                        <input type="number" placeholder="Number of Codes" class="form-control mt-3" name="code">

                        <div class="row pb-5">
                            <div class="col-12"><button type="submit"
                                    class="btn btn-block font-weight-bold btn-success btn-lg mt-4">Generate</button>
                            </div>
                            <!-- <div class="col-6"><button type="submit" name="signIn"
                                    class="btn btn-block font-weight-bold btn-info btn-lg mt-4">Submit</button></div> -->
                        </div>





                    </form>
                </div>


                <!-- <form action="" method="post"> -->

                <!-- </form> -->
            </div>

        </div>

    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script src="./js/parsley.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#generate').on('click', function() {
            let a = $('input[name=exampleRadios]:checked', '#myForm').val();
            let code = (a == 'STD') ? 'STD' + makeid(35) : 'LTD' + makeid(35);
            $('#code').val(code);
            console.log(code);
        });

        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        }
    });
    </script>
    <script>
    $(document).ready(function() {

        $('#myForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "ajax-code.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $('#output2').fadeIn().html(response);
                }
            });
            this.reset();
        });
    })
    </script>
</body>

</html>