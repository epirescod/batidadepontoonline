<?php
include 'config.php';

$new_password = password_hash("12345678", PASSWORD_DEFAULT);
$email = "emanuel.pires@test.com.br";

$sql = "UPDATE employees SET password = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $new_password, $email);

if ($stmt->execute()) {
    echo "Senha atualizada com sucesso!";
} else {
    echo "Erro ao atualizar senha: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
