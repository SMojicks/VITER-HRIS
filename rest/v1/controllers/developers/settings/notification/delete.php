<?php
$conn = null;
$conn = checkDbConnection();
$val = new Notification($conn);

$val->notification_aid = $_GET['id'];

$query = checkDelete($val);
http_response_code(200);
returnSuccess($val, "Notification Delete", $query);