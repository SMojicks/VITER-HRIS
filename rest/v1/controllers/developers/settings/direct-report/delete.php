<?php
// require_once guarantees that the CORS headers and the Employees model are loaded 
// without causing a "Cannot redeclare" crash if your router already loaded them.
require_once '../../../../core/header.php';
require_once '../../../../core/functions.php';
require_once '../../../../models/developers/employees/Employees.php';

$conn = null;
$conn = checkDbConnection();
$val = new Employees($conn);

// ModalDelete passes the ID via the URL string (?id=...)
if (isset($_GET['id'])) {
    $val->employee_aid = trim($_GET['id']);
    
    // Unset the supervisor fields. 
    // IMPORTANT: Use null for the ID instead of "" to prevent SQL database integer errors.
    $val->employee_supervisor_id = null; 
    $val->employee_supervisor_first_name = "";
    $val->employee_supervisor_last_name = "";
    $val->employee_supervisor_email = "";
    $val->employee_updated = date("Y-m-d H:i:s");

    // Reuse the update function to clear the specific columns
    $query = $val->updateDirectReport();

    if ($query) {
        http_response_code(200);
        returnSuccess($val, "Supervisor removed successfully", $query);
    } else {
        returnError($val, "Failed to remove supervisor.");
    }
} else {
    returnError($val, "Invalid employee ID.");
}