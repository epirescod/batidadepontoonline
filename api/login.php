<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include 'config.php'; // Conexão com o banco

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["identifier"]) || !isset($data["password"])) {
    echo json_encode(["status" => "error", "message" => "Dados inválidos."]);
    exit;
}

$identifier = trim($data["identifier"]); // Pode ser email ou ID de registro
$password = trim($data["password"]);

$sql = "SELECT id, name, email, password FROM employees WHERE email = ? OR registration_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $identifier, $identifier);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
        echo json_encode(["status" => "success", "message" => "Login bem-sucedido!", "user" => $user]);
    } else {
        echo json_encode(["status" => "error", "message" => "Senha incorreta."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Usuário não encontrado."]);
}

$stmt->close();
$conn->close();
?>
