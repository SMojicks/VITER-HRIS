<?php
// require_once guarantees the CORS headers and functions are loaded safely
require_once '../../../../core/header.php';
require_once '../../../../core/functions.php';
require_once '../../../../models/developers/employees/Employees.php';

// Handle CORS Preflight request safely
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$conn = null;
$conn = checkDbConnection();
$employee = new Employees($conn);

// Capture the JSON payload sent from the search/filter bar in React
$entityBody = file_get_contents('php://input');
$data = json_decode($entityBody, true);

$employee->search = $data['searchValue'] ?? "";
$employee->employee_is_active = $data['filterData'] ?? "";
$employee->start = isset($_GET['start']) ? $_GET['start'] : 1;
$employee->total = 50; // Set limit per page

// Execute the custom Direct Report methods we added to Employees.php
$query = $employee->readLimitDirectReports();
$totalQuery = $employee->readAllDirectReports();

$res = [];
if ($query && $query->rowCount() > 0) {
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $row;
    }
    
    // Exact JSON structure required by your React queryDataInfinite hook
    $return = [
        "success" => true,
        "count" => $query->rowCount(),
        "data" => $res,
        "total" => $totalQuery->rowCount(),
        "page" => (int)$employee->start
    ];
    http_response_code(200);
    echo json_encode($return);
} else {
    // Return empty state safely if no records exist
    $return = [
        "success" => true,
        "count" => 0,
        "data" => [],
        "total" => 0,
        "page" => (int)$employee->start
    ];
    http_response_code(200);
    echo json_encode($return);
}