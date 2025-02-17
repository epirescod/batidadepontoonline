<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["employee_id"]) || !isset($data["punch_type"]) || !isset($data["latitude"]) || !isset($data["longitude"]) || !isset($data["network_ip"])) {
    echo json_encode(["status" => "error", "message" => "Dados incompletos."]);
    exit;
}

$employee_id = $data["employee_id"];
$punch_type = $data["punch_type"];
$latitude = $data["latitude"];
$longitude = $data["longitude"];
$network_ip = $data["network_ip"];
$photo_path = ""; 

$sql = "INSERT INTO punches (employee_id, punch_type, latitude, longitude, network_ip, photo_path) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $employee_id, $punch_type, $latitude, $longitude, $network_ip, $photo_path);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Batida de ponto registrada!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Erro ao registrar batida."]);
}

$stmt->close();
$conn->close();
?>
