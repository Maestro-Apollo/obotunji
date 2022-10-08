<?php
session_start();

if (isset($_SESSION['admin'])) {
} else {
    header('location:login.php');
}
// include('class/database.php');
// class profile extends database
// {
//     protected $link;
//     public function showProfile()
//     {

//         # code...
//     }
// }
// $obj = new profile;
// $objShow = $obj->showProfile();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>
    <link rel="stylesheet" href="./css/site.css">
    <link rel="stylesheet" href="./css/richtext.min.css">
    <link rel="stylesheet" href="./css/range.css">
    <style>
    .profileImage {
        height: 200px;
        width: 200px;
        object-fit: cover;
        border-radius: 50%;
        margin: 10px auto;
        cursor: pointer;

    }



    .upload_btn {
        background-color: #EEA11D;
        color: #05445E;
        transition: 0.7s;
    }

    .upload_btn:hover {
        background-color: #05445E;
        color: #EEA11D;
    }

    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }

    .gap {
        margin-bottom: 95px;
    }

    body {
        font-family: 'Lato', sans-serif;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>


    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                            class="text-secondary font-weight-light">Welcome |</span>
                        Admin
                    </h3>

                    <div class="account bg-white mt-5 p-5 rounded">

                        <h3 class="font-weight-bold mb-5" style="color: #05445E">Inventory</h3>
                        <form action="" id="myForm" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <label for="name" class="font-weight-bold">Name</label>
                                    <input type="text" id="name" name="name" class="form-control bg-light">

                                    <label for="barcode" class="font-weight-bold mt-4 mb-0">Barcode</label>
                                    <input type="text" id="barcode" name="barcode" class="form-control bg-light mb-3">

                                    <label for="">Wholesale Price</label>
                                    <div class="range mb-3">
                                        <input type="range" name="wholesale" min="1" max="30" class="range1" value="15">
                                        <output id="range">£15</output>
                                    </div>
                                    <input type="hidden" name="w-price" id="w-price">
                                    <label for="">Retail Price</label>
                                    <div class="range range-primary mb-3">
                                        <input type="range" name="retail" min="1" max="30" class="range2" value="15">
                                        <output id="rangePrimary">£15</output>
                                    </div>
                                    <input type="hidden" name="r-price" id="r-price">
                                    <label for="">Quantity</label>
                                    <div class="range range-success mb-3">
                                        <input type="range" name="quantity" min="1" max="100" class="range3" value="50">
                                        <output id="rangeSuccess">50</output>
                                    </div>
                                    <input type="hidden" name="quantity" id="quantity">





                                </div>
                                <div class="col-md-5 text-center">

                                    <img class="profileImage" onclick="triggerClick()" id="profileDisplay"
                                        src="item_img/placeholder-16-9.jpg" alt="">
                                    <input type="file" accept="image/*" name="image" id="profileImage"
                                        onchange="displayImage(this)" style="display: none;">
                                    <p class="lead gap">Tap to upload image</p>
                                    <!-- <input class="btn font-weight-bold log_btn btn-lg mt-5" type="submit"
                                        value="Confirm Changes">
                                    </input> -->

                                </div>
                            </div>

                    </div>
                    <input class="btn font-weight-bold log_btn btn-lg mt-5 mb-3" type="submit" value="Submit">
                    </input>
                    </form>
                    <div id="output"></div>

                </div>

            </div>
        </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script>
    //This ajax call will take the user info to update.php
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "update.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#output').fadeIn().html(response);
                    setTimeout(() => {
                        $('#output').fadeOut('slow');
                    }, 2000);
                }
            });

        });
    })
    </script>

    <script>
    $(document).ready(function() {
        let range = $('.range1');
        range.on('input', function() {
            console.log(range.val());
            $('#range').text('£' + range.val());
            $('#w-price').val(range.val());
        })

        let range2 = $('.range2');
        range2.on('input', function() {
            console.log(range.val());
            $('#rangePrimary').text('£' + range2.val());
            $('#r-price').val(range2.val());
        })

        let range3 = $('.range3');
        range3.on('input', function() {
            console.log(range3.val());
            $('#rangeSuccess').text(range3.val());
            $('#quantity').val(range3.val());

        })
    })
    </script>


</body>

</html>