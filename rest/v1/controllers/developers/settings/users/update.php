<?php 


// checkdatabase connection
$conn = null;
$conn = checkDbConnection();      
// make use of classes for save database
$val = new Users($conn);

if(array_key_exists("id",$_GET)){
$val->users_aid = $_GET['id'];
$val->users_name = $data['users_name'];
$val->users_description = $data['users_description'];
$val->users_updated = date("Y-m-d H:m:s");

$users_name_old = $data['users_name_old'];

// VALIDATIONS
checkId($val->users_aid);
compareName(
    $val, //models
    $users_name_old, //old record
    $val->users_name //new record
    );

$query = checkUpdate($val);
http_response_code(200);
returnSuccess($val, "Roles Update", $query);
}

checkEndpoint();

