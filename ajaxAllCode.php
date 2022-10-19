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
    $columnName = ' code_id'; // Column name
    $columnSortOrder = ' ASC'; // asc or desc

    $searchValue = mysqli_escape_string($con, $_POST['search']['value']); // Search value



    ## Search 
    $searchQuery = " ";
    if ($searchValue != '') {
        $searchQuery = " and (code like '%" . $searchValue . "%')  ";
    }

    ## Total number of records without filtering
    $sel = mysqli_query($con, "select count(*) as allcount from code_tbl WHERE DATE(`created_at`) = CURDATE()");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $sel = mysqli_query($con, "select count(*) as allcount from code_tbl WHERE DATE(`created_at`) = CURDATE()" . $searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from code_tbl WHERE DATE(`created_at`) = CURDATE()" . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    $i = 0;

    while ($row = mysqli_fetch_assoc($empRecords)) {

        $newDate = date("d/m/Y H:i:s", strtotime($row['created_at']));

        $i++;

        $data[] = array(
            "code_id" => $i,
            "code" => $row['code'],
            "created_at" => $newDate,
            "status" => $status,

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