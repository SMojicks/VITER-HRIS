<?php 


// checkdatabase connection
$conn = null;
$conn = checkDbConnection();      
// make use of classes for save database
$val = new Employees($conn);

if(array_key_exists("id",$_GET)){
$val->employee_aid = $_GET['id'];
$val->employee_first_name = $data['employee_first_name'];
$val->employee_updated = date("Y-m-d H:m:s");

$employee_name_old = $data['employee_name_old'];

// VALIDATIONS
checkId($val->employee_aid);
compareName(
    $val, //models
    $employee_name_old, //old record
    $val->employee_first_name //new record
    );

$query = checkUpdate($val);
http_response_code(200);
returnSuccess($val, "employees Update", $query);
}

checkEndpoint();

