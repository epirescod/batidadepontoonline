<?php
include 'config.php';

$email = "emanuel.pires@test.com.br";
$sql = "SELECT * FROM employees WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode(["status" => "success", "message" => "Usuário encontrado!", "user" => $user]);
} else {
    echo json_encode(["status" => "error", "message" => "Usuário não encontrado."]);
}

$stmt->close();
$conn->close();
?>
