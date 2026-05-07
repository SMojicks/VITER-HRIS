<?php
require_once '../../../../core/header.php';
require_once '../../../../core/functions.php';
require_once '../../../../models/developers/employees/Employees.php';

// Handle CORS Preflight request safely for PUT methods
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$conn = null;
$conn = checkDbConnection();
$val = new Employees($conn);

// Capture the JSON payload sent from React
if (empty($data)) {
    $entityBody = file_get_contents('php://input');
    $data = json_decode($entityBody, true);
}

// Safely map the data
$val->employee_aid = trim($data['subordinate_id'] ?? '');
$val->employee_supervisor_id = trim($data['supervisor_id'] ?? '');
$val->employee_updated = date("Y-m-d H:i:s");

// 1. Validation: Same person cannot be their own supervisor
if ($val->employee_aid === $val->employee_supervisor_id) {
    returnError("An employee cannot be their own supervisor.");
}

// 2. Validation: Duplicate Assignment
// Check if the subordinate is already assigned to this exact supervisor
$subordinateDetails = $val->getEmployeeDetails($val->employee_aid);
if ($subordinateDetails && $subordinateDetails['employee_supervisor_id'] == $val->employee_supervisor_id) {
    returnError("This employee is already assigned to the selected supervisor.");
}

// 3. Validation: Circular Dependency
if ($val->checkCircularDependency($val->employee_supervisor_id, $val->employee_aid)) {
    returnError("Invalid request, the supervisor cannot be assigned to the selected subordinate.");
}

// 4. Get Supervisor Details to populate the name and email columns
$supervisorDetails = $val->getEmployeeDetails($val->employee_supervisor_id);
if ($supervisorDetails) {
    $val->employee_supervisor_first_name = $supervisorDetails['employee_first_name'];
    $val->employee_supervisor_last_name = $supervisorDetails['employee_last_name'];
    $val->employee_supervisor_email = $supervisorDetails['employee_email'];
}

// 5. Execute the specific direct report update query
$query = $val->updateDirectReport();

if ($query) {
    http_response_code(200);
    returnSuccess($val, "Direct Report Updated", $query);
} else {
    returnError("Failed to update direct report.");
}