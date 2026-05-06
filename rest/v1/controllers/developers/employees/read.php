<?php 
// Don't forget to include your headers and model at the top!
require '../../../core/header.php';
require '../../../core/functions.php';
require '../../../models/developers/employees/Employees.php';

// checkdatabase connection
$conn = null;
$conn = checkDbConnection();      
// make use of classes for save database
$val = new Employees($conn);

if(array_key_exists("id", $_GET)){
    $val->employee_aid = $_GET['id'];
    checkId($val->employee_aid);
    $query = checkReadById($val);
    http_response_code(200);
    getQueriedData($query);
} else {
    // --- ADDED FOR DASHBOARD ---
    // Ensure we only fetch active employees (not archived ones)
    $val->employee_is_active = 1; 
    $val->search = ""; // Ensure search is empty so it doesn't accidentally filter
    // ---------------------------

    $query = checkReadAll($val);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();