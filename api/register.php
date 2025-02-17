<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["name"]) || !isset($data["email"]) || !isset($data["password"]) || !isset($data["registration_id"])) {
    echo json_encode(["status" => "error", "message" => "Dados incompletos."]);
    exit;
}

$name = trim($data["name"]);
$email = trim($data["email"]);
$password = password_hash(trim($data["password"]), PASSWORD_DEFAULT);
$registration_id = trim($data["registration_id"]);

$sql = "INSERT INTO employees (name, email, password, registration_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $password, $registration_id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Usuário cadastrado com sucesso!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Erro ao cadastrar usuário."]);
}

$stmt->close();
$conn->close();
?>
