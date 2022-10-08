<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: GET");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

include('../class/database.php');
class Inventory extends database
{
    public function getInventory()
    {
        $sql = "SELECT * from info_tbl order by info_id DESC";
        $res = mysqli_query($this->link, $sql);
        $arr = array();
        if (mysqli_num_rows($res) > 0) {
            foreach ($res as $row) {
                $arr[] = $row;
            }
            return array('status' => true, 'data' => $arr);
        } else {
            return array('status' => false, 'data' => $arr);
        }
    }
}

$obj = new Inventory;
echo json_encode($obj->getInventory());