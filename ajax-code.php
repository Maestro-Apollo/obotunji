<?php
session_start();

include('class/database.php');
class Code extends database
{
  public function insertData()
  {
    $type = $_POST['exampleRadios'];

    $s_code = NULL;
    $l_code = NULL;

    ($type == 'STD') ? $s_code = $_POST['code'] : $l_code = $_POST['code'];

    $search = ($type == 'STD') ? $s_code : $l_code;

    $url = $_POST['url'];


    $sqlFind = "SELECT * from code_tbl where s_code = '$search' or l_code = '$search'";
    $resFind = mysqli_query($this->link, $sqlFind);
    if (mysqli_num_rows($resFind) > 0) {
      return '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Code Already Exist!</strong>
          </div>';
    } else {
      $sql = "INSERT INTO `code_tbl` (`code_id`, `s_code`, `l_code`, `url`, `status`) VALUES (NULL, '$s_code', '$l_code', '$url','Not Used')";
      $res = mysqli_query($this->link, $sql);
      if ($res) {
        return '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Code is Added</strong>
              </div>';
      } else {
        return '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Invalid!</strong>
              </div>';
      }
    }
  }
}
$obj = new Code;
echo $obj->insertData();