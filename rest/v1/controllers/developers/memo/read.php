<?php 

// checkdatabase connection
$conn = null;
$conn = checkDbConnection();      
// make use of classes for save database
$val = new Memo($conn);

if(array_key_exists("id", $_GET)){
    $val->memo_aid = $_GET['id'];
    checkId($val->memo_aid);
    $query = checkReadById($val);
    http_response_code(200);
    getQueriedData($query);
} else {
    $query = checkReadAll($val);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();