<?php

require '../app/Models/Usuario.php';

class UsuarioController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new Usuario($pdo);
    }

    public function listarUsuarios()
    {
        return $this->model->getAllUsuarios();
    }

    public function adicionarUsuario($nome, $email, $situacao, $data_admissao)
    {
        $this->model->addUsuario($nome, $email, $situacao, $data_admissao);
    }

    public function editarUsuario($id, $nome, $email, $situacao, $data_admissao)
    {
        $this->model->updateUsuario($id, $nome, $email, $situacao, $data_admissao);
    }

    public function excluirUsuario($id)
    {
        $this->model->deleteUsuario($id);
    }

    public function listarUsuariosFiltrados($nome = '', $email = '')
    {
        return $this->model->getUsuariosFiltrados($nome, $email);
    }

}
