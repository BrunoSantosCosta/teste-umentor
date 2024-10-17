<?php

require '../config/database.php';
require '../app/Controllers/UsuarioController.php';
require '../app/Views/usuarios.php';

$pdo = conectarBancoDeDados();

$controller = new UsuarioController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'excluir') {

    $controller->excluirUsuario($_POST['id']);
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editar') {

    $controller->editarUsuario($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['situacao'], $_POST['data_admissao']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['acao'])) {
    $controller->adicionarUsuario($_POST['nome'], $_POST['email'], $_POST['situacao'], $_POST['data_admissao']);

}

$filtro_nome = isset($_GET['filtro_nome']) ? $_GET['filtro_nome'] : '';
$filtro_email = isset($_GET['filtro_email']) ? $_GET['filtro_email'] : '';

$usuarios = $controller->listarUsuariosFiltrados($filtro_nome, $filtro_email);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários - MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <h1 class="mt-5 text-center">Gerenciamento de Usuários</h1>

        <div class="row">
            <div class="col-12 col-md-4 mt-4">
                <form id="formAdicionarUsuario" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="situacao" class="form-label">Situação</label>
                        <select class="form-select" id="situacao" name="situacao" required>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="data_admissao" class="form-label">Data de Admissão</label>
                        <input type="date" class="form-control" id="data_admissao" name="data_admissao" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Adicionar Usuário</button>
                </form>
            </div>

            <div class="col-12 col-md-8 mt-4">
                <div class="row mb-3">
                    <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                        <input type="text" class="form-control" id="filtro-nome" placeholder="Filtrar por nome">
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="text" class="form-control" id="filtro-email" placeholder="Filtrar por email">
                    </div>
                </div>

                <div id="tabela-usuarios" class="table-responsive">
                    <?php exibirUsuarios($usuarios); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/app.js"></script>
</body>
</html>
