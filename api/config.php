<?php
// config.php
$host = "localhost";
$user = "emanuel";       // geralmente "root" no XAMPP/WAMP, se não houver senha
$password = "M1k3b0b1";     // se houver senha, caso contrário deixe em branco
$dbname = "sistema_ponto";

// Cria a conexão
$conn = new mysqli($host, $user, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
