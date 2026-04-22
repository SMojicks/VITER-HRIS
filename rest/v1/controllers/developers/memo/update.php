<?php 

// checkdatabase connection
$conn = null;
$conn = checkDbConnection();      
// make use of classes for save database
$val = new Memo($conn);

if(array_key_exists("id", $_GET)){
    $val->memo_aid = $_GET['id'];
    $val->memo_from = trim($data['memo_from']);
    $val->memo_to = trim($data['memo_to']);
    $val->memo_date = trim($data['memo_date']);
    $val->memo_category = trim($data['memo_category']);
    $val->memo_text = trim($data['memo_text']);
    
    $val->memo_updated = date("Y-m-d H:i:s");
    
    $memo_category_old = trim($data['memo_category_old']);
    
    // VALIDATIONS
    checkId($val->memo_aid);
    compareName(
        $val, //models
        $memo_category_old, //old record
        $val->memo_category //new record
    );
    
    $query = checkUpdate($val);
    http_response_code(200);
    returnSuccess($val, "Memo Update", $query);
}

checkEndpoint();