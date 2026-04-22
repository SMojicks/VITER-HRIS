<?php 
//set http header
require '../../../core/header.php';
// use needed functions
require '../../../core/functions.php'; 
//use models
require '../../../models/developers/memo/Memo.php'; 

// get payload from frontend
$body = file_get_contents("php://input");
$data = json_decode($body, true);

// checkdatabase connection
$conn = null;
$conn = checkDbConnection();      
// make use of classes for save database
$val = new Memo($conn);

if(array_key_exists("id", $_GET)){
    $val->memo_aid = $_GET['id'];
    $val->memo_is_active = trim($data['isActive']);
    $val->memo_updated = date("Y-m-d H:i:s");

    // VALIDATIONS
    checkId($val->memo_aid);
    
    $query = checkActive($val);
    http_response_code(200);
    returnSuccess($val, "Memo Active", $query);
}

checkEndpoint();