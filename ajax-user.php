<?php
session_start();

include 'config.php';

$request = 1;
if (isset($_POST['request'])) {
  $request = $_POST['request'];
}

// DataTable data
if ($request == 1) {
  ## Read value
  $draw = $_POST['draw'];
  $row = $_POST['start'];
  $rowperpage = $_POST['length']; // Rows display per page
  $columnIndex = $_POST['order'][0]['column']; // Column index
  $columnName = ' user_id'; // Column name
  $columnSortOrder = ' DESC'; // asc or desc

  $searchValue = mysqli_escape_string($con, $_POST['search']['value']); // Search value



  ## Search 
  $searchQuery = " ";
  if ($searchValue != '') {
    $searchQuery = " and (code_tbl.s_code like '%" . $searchValue . "%' or 
      code_tbl.l_code like '%" . $searchValue . "%'  or 
      code_tbl.url like '%" . $searchValue . "%' or 
            user_tbl.fname like '%" . $searchValue . "%' or 
            user_tbl.lname like '%" . $searchValue . "%' or 
            user_tbl.email like '%" . $searchValue . "%' or 
            code_tbl.status like '%" . $searchValue . "%' )  ";
  }

  ## Total number of records without filtering
  $sel = mysqli_query($con, "select count(*) as allcount from code_tbl inner join user_tbl on code_tbl.code_id = user_tbl.code_id");
  $records = mysqli_fetch_assoc($sel);
  $totalRecords = $records['allcount'];

  ## Total number of records with filtering
  $sel = mysqli_query($con, "select count(*) as allcount from code_tbl inner join user_tbl on code_tbl.code_id = user_tbl.code_id WHERE 1" . $searchQuery);
  $records = mysqli_fetch_assoc($sel);
  $totalRecordwithFilter = $records['allcount'];

  ## Fetch records
  $empQuery = "select * from code_tbl inner join user_tbl on code_tbl.code_id = user_tbl.code_id WHERE 1" . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
  $empRecords = mysqli_query($con, $empQuery);
  $data = array();


  while ($row = mysqli_fetch_assoc($empRecords)) {


    $data[] = array(
      "user_id" => $row['user_id'],
      "fname" => $row['fname'],
      "lname" => $row['lname'],
      "email" => $row['email'],
      "s_code" => $row['s_code'],
      "l_code" => $row['l_code'],
      "url" => $row['url'],
      "status" => $row['status'],
    );
  }

  ## Response
  $response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
  );

  echo json_encode($response);
  exit;
}