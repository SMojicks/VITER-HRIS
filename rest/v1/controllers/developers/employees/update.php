<?php 
// check database connection
$conn = null;
$conn = checkDbConnection();      
// make use of classes for save database
$val = new Employees($conn);

$val->employee_first_name = trim($data['employee_first_name']);
$val->employee_middle_name = trim($data['employee_middle_name']);
$val->employee_last_name = trim($data['employee_last_name']);
$val->employee_department_id = trim($data['employee_department_id']); // NEW
$val->employee_email = trim($data['employee_email']);
$val->employee_updated = date("Y-m-d H:i:s");
$val->employee_aid = $_GET['id'];

// VALIDATIONS
// checkId($val->employee_aid);

$query = checkUpdate($val);
http_response_code(200);
returnSuccess($val, "Employee Update", $query);