<?php
session_start();
date_default_timezone_set('Canada/Central');

include('class/database.php');
class Code extends database
{
  public function insertData()
  {
    $type = $_POST['exampleRadios'];

    $code = $_POST['code'];

    function generateRandomString($length, $type)
    {
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      $randomString .= $type;
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    $x = 0;

    for ($i = 0; $i < $code; $i++) {

      $theCode = generateRandomString(35, $type);


      $sql = "INSERT INTO `code_tbl` (`code_id`, `code`, `created_at`,`status`) VALUES (NULL, '$theCode', current_timestamp(), 'Not Used')";
      $res = mysqli_query($this->link, $sql);
      if ($res) {
        $x++;
      }
    }

    if ($x > 0) {
      return '<div class="alert alert-success alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Code Added!</strong>
  </div>';
    }
  }
}
$obj = new Code;
echo $obj->insertData();