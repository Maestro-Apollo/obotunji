<?php
session_start();

include('class/database.php');
class profile extends database
{
    protected $link;

    public function insertProfileInfo()
    {
        if (isset($_POST['barcode'])) {
            $name = $_POST['name'];
            $barcode = $_POST['barcode'];
            $w_price = $_POST['w-price'];
            $r_price = $_POST['r-price'];
            $quantity = $_POST['quantity'];
            $img = time() . '_' . $_FILES['image']['name'];
            $target = 'item_img/' . $img;

            $sqlFind = "SELECT * from info_tbl where barcode = '$barcode' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $row = mysqli_fetch_assoc($resFind);
                $oldQuantity = $row['quantity'];
                $newQuantity = $oldQuantity + $quantity;

                if (isset($_FILES['image']['name']) == '') {
                    $sql = "UPDATE info_tbl SET `name` = '$name', `wholesale` = '$w_price', `retail` = '$r_price', `quantity` = '$newQuantity' where barcode = '$barcode' ";
                } else {
                    $sql = "UPDATE info_tbl SET `name` = '$name', `wholesale` = '$w_price', `retail` = '$r_price', `quantity` = '$newQuantity', `image` = '$img' where barcode = '$barcode' ";
                }
            } else {
                $sql = "INSERT INTO `info_tbl` (`info_id`, `barcode`, `name`, `image`, `wholesale`, `retail`, `quantity`) VALUES (NULL, '$barcode', '$name', '$img', '$w_price', '$r_price', '$quantity')";
            }




            $res = mysqli_query($this->link, $sql);
            if ($res) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                echo '<div class="alert alert-success">
                <strong>Successfully Added!</strong>
            </div>';
            } else {
                echo "Not added";
            }
        }
        # code...
    }
}
$obj = new profile;
$objInsertInfo = $obj->insertProfileInfo();