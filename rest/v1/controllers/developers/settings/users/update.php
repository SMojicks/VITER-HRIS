<?php 
// checkdatabase connection
$conn = null;
$conn = checkDbConnection();      
// make use of classes for save database
$val = new Users($conn);

if(array_key_exists("id",$_GET)){
    $val->users_aid = $_GET['id'];
    $val->users_first_name = trim($data['users_first_name']);
    $val->users_last_name = trim($data['users_last_name']);
    $val->users_email = trim($data['users_email']);
    $val->users_role_id = $data['users_role_id']; 
    $val->users_updated = date("Y-m-d H:m:s");


    // VALIDATIONS
    checkId($val->users_aid);

    isNameExist($val, $val->users_first_name . " " . $val->users_last_name);
    isEmailExist($val, $val->users_email);


    $query = checkUpdate($val);
    http_response_code(200);
    returnSuccess($val, "Users Update", $query);
}

checkEndpoint();