<?php
function conectarBancoDeDados()
{
    $host = 'localhost';
    $db = 'teste_umentor';
    $user = 'root';
    $pass = '';

    try {
        return new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    } catch (PDOException $e) {
        die("Erro de conexão: " . $e->getMessage());
    }
}
