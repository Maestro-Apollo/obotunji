<?php
session_start();
header('location: register.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>


    <style>
    .navbar-brand {
        width: 10% !important;
    }

    .bg_color {
        background-color: #fff !important;
    }

    body {
        font-family: 'Raleway', sans-serif;
    }

    .carousel-caption {
        top: 50%;
        transform: translateY(-50%);
        bottom: initial;
        -webkit-transform-style: preserve-3d;
        -moz-transform-style: preserve-3d;
        transform-style: preserve-3d;
    }

    .carousel .carousel-item {
        height: 80vh;
    }

    .carousel-item img {
        position: absolute;
        top: 0;
        left: 0;
        min-height: 80vh;
        object-fit: cover;

    }

    section {
        padding: 60px 0;
    }

    .carousel-item:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
    }
    </style>


</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>






    <section>
        <div class="container text-center">
            <a href="./add-stock.php" class="btn log_btn">Add Stock Item</a>
        </div>
    </section>




    <?php include('layout/script.php') ?>


</body>

</html>