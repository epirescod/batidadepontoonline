<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'config.php';

if (!isset($_GET["employee_id"])) {
    echo json_encode(["status" => "error", "message" => "ID do funcionário necessário."]);
    exit;
}

$employee_id = $_GET["employee_id"];

$sql = "SELECT * FROM punches WHERE employee_id = ? ORDER BY punch_time DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();

$punches = [];
while ($row = $result->fetch_assoc()) {
    $punches[] = $row;
}

echo json_encode(["status" => "success", "punches" => $punches]);

$stmt->close();
$conn->close();
?>
