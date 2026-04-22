<?php 

// checkdatabase connection
$conn = null;
$conn = checkDbConnection();      
// make use of classes for save database
$val = new Memo($conn);

if(array_key_exists("id", $_GET)){
    $val->memo_aid = $_GET['id'];

    // VALIDATIONS
    checkId($val->memo_aid);
    
    $query = checkDelete($val);
    http_response_code(200);
    returnSuccess($val, "Memo Delete", $query);
}

checkEndpoint();