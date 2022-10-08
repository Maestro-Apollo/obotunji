<?php
session_start();
include('./class/database.php');
if (isset($_SESSION['name'])) {
} else {
    header('location:login.php');
}
class Inventory extends database
{
    public function inventoryFunction()
    {
        $sql = "SELECT * from info_tbl";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new Inventory;
$objInventory = $obj->inventoryFunction();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
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
        <div class="container bg-white p-3">
            <table id="example" class="table table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Barcode</th>
                        <th>Name</th>
                        <th>Wholesale</th>
                        <th>Retail</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($objInventory) { ?>
                    <?php while ($row = mysqli_fetch_assoc($objInventory)) { ?>
                    <tr>
                        <td><img src="item_img/<?php echo $row['image']; ?>" alt="" class="w-50"></td>
                        <td><?php echo $row['barcode']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['wholesale']; ?></td>
                        <td><?php echo $row['retail']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>

                </tbody>

            </table>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>

</body>

</html>