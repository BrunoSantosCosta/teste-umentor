<?php


function exibirUsuarios($usuarios)
{
    echo '<table class="table table-bordered">';
    echo '<thead><tr><th>ID</th><th>Nome</th><th>Email</th><th>Situação</th><th>Data de Admissão</th><th>Data de Cadastro</th><th>Data de Atualização</th><th>Ações</th></tr></thead>';
    echo '<tbody>';
    foreach ($usuarios as $usuario) {

        $dataAdmissao = (new DateTime($usuario['data_admissao']))->format('d/m/Y');
        $dataCadastro = (new DateTime($usuario['data_cadastro']))->format('d/m/Y H:i:s');
        $dataAtualizacao = (new DateTime($usuario['data_atualizacao']))->format('d/m/Y H:i:s');

        echo "<tr data-id='{$usuario['id']}'>
                <td>{$usuario['id']}</td>
                <td class='nome'>{$usuario['nome']}</td>
                <td class='email'>{$usuario['email']}</td>
                <td class='situacao'>{$usuario['situacao']}</td>
                <td class='data_admissao'>{$dataAdmissao}</td>
                <td>{$dataCadastro}</td>
                <td class='data_atualizacao'>{$dataAtualizacao}</td>
                <td>
                    <button class='btn btn-warning btn-editar' data-id='{$usuario['id']}'>Editar</button>
                    <button class='btn btn-success btn-salvar' data-id='{$usuario['id']}' style='display:none;'>Salvar</button>
                    <button class='btn btn-danger btn-excluir' data-id='{$usuario['id']}'>Excluir</button>
                </td>
              </tr>";
    }
    echo '</tbody></table>';
}