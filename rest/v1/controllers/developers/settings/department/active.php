<?php
require '../../../../core/header.php';
require '../../../../core/functions.php';
require '../../../../models/developers/settings/department/Department.php';

$body = file_get_contents("php://input");
$data = json_decode($body, true);

$conn = null;
$conn = checkDbConnection();
$val = new Department($conn);

$val->department_is_active = trim($data["isActive"]);
$val->department_updated = date("Y-m-d H:i:s");
$val->department_aid = $_GET['id'];

$query = checkActive($val);
http_response_code(200);
returnSuccess($val, "Department Active Status Update", $query);