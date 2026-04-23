<?php
$conn = null;
$conn = checkDbConnection();
$val = new Department($conn);

$val->department_name = trim($data['department_name']);
$val->department_updated = date("Y-m-d H:i:s");
$val->department_aid = $_GET['id'];

$query = checkUpdate($val);
http_response_code(200);
returnSuccess($val, "Department Update", $query);