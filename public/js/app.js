$(document).ready(function() {
    function filtrarUsuarios() {
        var nomeFiltro = $('#filtro-nome').val();
        var emailFiltro = $('#filtro-email').val();

        $.ajax({
            type: 'GET',
            url: '',
            data: {
                filtro_nome: nomeFiltro,
                filtro_email: emailFiltro
            },
            success: function(response) {
                $('#tabela-usuarios').html($(response).find('#tabela-usuarios').html());
            },
            error: function() {
                Swal.fire('Erro!', 'Erro ao filtrar o usuário.', 'error');
            }
        });
    }

    $('#filtro-nome, #filtro-email').on('input', function() {
        filtrarUsuarios();
    });

    $('#formAdicionarUsuario').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '',
            data: formData,
            success: function(response) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Usuário adicionado com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
                atualizarTabelaUsuarios();
                $('#formAdicionarUsuario')[0].reset();
            },
            error: function() {
                Swal.fire('Erro!', 'Erro ao adicionar o usuário.', 'error');
            }
        });
    });

    $(document).on('click', '.btn-editar', function() {
        var row = $(this).closest('tr'); 
        row.find('.nome, .email, .situacao, .data_admissao').each(function() {
            var content = $(this).text();
            $(this).html('<input type="text" class="form-control" value="' + content + '">');
        });
        row.find('.situacao').html('<select class="form-select"><option value="Ativo">Ativo</option><option value="Inativo">Inativo</option></select>');
        row.find('.btn-editar').hide();
        row.find('.btn-salvar').show();
        $('#formAdicionarUsuario')[0].reset();
    });

    $(document).on('click', '.btn-salvar', function() {
        var row = $(this).closest('tr');
        var userId = $(this).data('id');

        var nome = row.find('.nome input').val();
        var email = row.find('.email input').val();
        var situacao = row.find('.situacao select').val();
        var dataAdmissao = row.find('.data_admissao input').val();
        var partesData = dataAdmissao.split('/');
        var dataAdmissaoCorrigida = partesData[2] + '-' + partesData[1] + '-' + partesData[0];
    
        $('#formAdicionarUsuario')[0].reset();
        $.ajax({
            type: 'POST',
            url: '', 
            data: {
                acao: 'editar',
                id: userId,
                nome: nome,
                email: email,
                situacao: situacao,
                data_admissao: dataAdmissaoCorrigida
            },
            success: function(response) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Usuário editado com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
                var currentDate = new Date();
                var formattedDate = ("0" + currentDate.getDate()).slice(-2) + "/" +
                ("0" + (currentDate.getMonth() + 1)).slice(-2) + "/" +
                currentDate.getFullYear() + " " +
                ("0" + currentDate.getHours()).slice(-2) + ":" +
                ("0" + currentDate.getMinutes()).slice(-2) + ":" +
                ("0" + currentDate.getSeconds()).slice(-2);


                row.find('.nome').text(nome);
                row.find('.email').text(email);
                row.find('.situacao').text(situacao);
                row.find('.data_admissao').text(dataAdmissao);
                row.find('.data_atualizacao').text(formattedDate);
                row.find('.btn-salvar').hide();
                row.find('.btn-editar').show();
                $('#formAdicionarUsuario')[0].reset();
            },
            error: function() {
                Swal.fire('Erro!', 'Erro ao salvar os dados do usuário.', 'error');
            }
        });
    });

    $(document).on('click', '.btn-excluir', function() {
        var userId = $(this).data('id');

        Swal.fire({
            title: 'Você tem certeza?',
            text: 'Este usuário será excluído definitivamente!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: { acao: 'excluir', id: userId },
                    success: function(response) {
                        Swal.fire('Excluído!', 'O usuário foi excluído.', 'success');
                        atualizarTabelaUsuarios();
                    },
                    error: function() {
                        Swal.fire('Erro!', 'Erro ao excluir o usuário.', 'error');
                    }
                });
            }
        });
    });

    function atualizarTabelaUsuarios() {
        $.ajax({
            url: '',
            type: 'GET',
            success: function(response) {
                $('#tabela-usuarios').html($(response).find('#tabela-usuarios').html());
            },
            error: function() {
                alert('Erro ao atualizar a tabela de usuários.');
            }
        });
    }
});
