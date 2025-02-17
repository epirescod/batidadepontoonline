<?php
include 'config.php';

if ($conn) {
    echo "Conexão com o banco de dados bem-sucedida!";
} else {
    echo "Erro ao conectar ao banco de dados.";
}
?>