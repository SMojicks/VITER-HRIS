<?php
require '../../../../core/header.php';
require '../../../../core/functions.php';
require '../../../../models/developers/settings/notification/Notification.php';

$body = file_get_contents("php://input");
$data = json_decode($body, true);

$conn = null;
$conn = checkDbConnection();
$val = new Notification($conn);

$val->notification_is_active = trim($data["isActive"]);
$val->notification_aid = $_GET['id'];
$val->notification_updated = date("Y-m-d H:m:s");

$query = checkActive($val);
http_response_code(200);
returnSuccess($val, "Notification Active Status Update", $query);