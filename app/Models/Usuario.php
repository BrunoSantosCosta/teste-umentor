<?php

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllUsuarios()
    {
        $stmt = $this->pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUsuario($nome, $email, $situacao, $data_admissao)
    {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email, situacao, data_admissao) VALUES (?, ?, ?,?)");
        return $stmt->execute([$nome, $email, $situacao, $data_admissao]);
    }

    public function updateUsuario($id, $nome, $email, $situacao, $data_admissao)
    {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, situacao = ?, data_admissao = ?, data_atualizacao = NOW() WHERE id = ?");
        return $stmt->execute([$nome, $email, $situacao, $data_admissao, $id]);
    }

    public function deleteUsuario($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getUsuariosFiltrados($nome, $email)
    {
        $query = "SELECT * FROM usuarios WHERE 1=1";

        if (!empty($nome)) {
            $query .= " AND nome LIKE :nome";
        }
        if (!empty($email)) {
            $query .= " AND email LIKE :email";
        }

        $stmt = $this->pdo->prepare($query);

        if (!empty($nome)) {
            $stmt->bindValue(':nome', '%' . $nome . '%');
        }
        if (!empty($email)) {
            $stmt->bindValue(':email', '%' . $email . '%');
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
