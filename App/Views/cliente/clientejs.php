<script>
   
    $(document).ready(function() {
        const token = $('#CSRF_token').attr("data-token");

        // INCLUIR NOVO CLIENTE
        $('#btIncluir').on('click', function() {
    
            $("#nome").val("");
            $("#cpf").val("");
            $("#endereco").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#cep").val("");
            $("#telefone").val("");
            $("#email").val("");
            $("#mensagem_erro").html("");
            $("#mensagem_erro").removeClass("alert alert-danger")

            $('[name="CSRF_token"]').val(token)

            $("#modalNovoCliente").modal('show');
        })


        // salvar os dados da inclusão
        $('#btSalvarInclusao').on('click', function() {
            $.ajax({
                url: "<?= url('cliente') ?>", // chama o método para inclusão
                type: "POST",
                data: $('#formInclusao').serialize(), //codifica o formulário como uma string para envio.
                dataType: "JSON",
                success: function(data) {
                    $('[name="CSRF_token"]').val(data.token); // // Update CSRF hash
                    if (data.status) //if success close modal and reload ajax table
                    {  Swal.fire({
                            title: "Sucesso",
                            text: "Cliente Incluído Com Sucesso",
                            icon: "success",
                        });
                        $("#modalNovoCliente").modal('hide');

                        setTimeout(function() {
                            location.reload();
                        }, 1000); 
                    } else {
                        $('[name="mensagem_erro"]').addClass('alert alert-danger');
                        $('[name="mensagem_erro"]').html(data.erros);
                    }
                },
                error: function(data) {
                    Swal.fire({
                        title: "Erro",
                        text: "Erro Inesperado",
                        icon: "error",
                    });
                    $("#modalNovoCliente").modal('hide');
                }
            });
        })


        // ************************************************************************
        // ALTERAÇÃO DOS DADOS DO CLIENTE

        $(document).on("click", "#btAlterar", function() {

            var id = $(this).attr("data-id");
    
            $("#nome_alteracao").val("");
            $("#cpf_alteracao").val("");
            $("#endereco_alteracao").val("");
            $("#bairro_alteracao").val("");
            $("#cidade_alteracao").val("");
            $("#uf_alteracao").val("");
            $("#cep_alteracao").val("");
            $("#telefone_alteracao").val("");
            $("#email_alteracao").val("");
            $("#mensagem_erro_alteracao").html("");
            $("#mensagem_erro_alteracao").removeClass("alert alert-danger")

            $('[name="CSRF_token"]').val(token)

            $('[name="id_alteracao"]').val(id);

            $("#modalAlterarCliente").modal('show');
            
        });

        // salvar dados da altercao do cliente
        $('#btSalvarAlteracao').on('click', function() {
            var id = $('[name="id_alteracao"]').attr("value");

            $.ajax({
                url: "<?= url('cliente') ?>" + "/" + id,
                type: "PUT",
                data: $('#formAltercao').serialize(),
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    // Update CSRF hash
                    $('[name="CSRF_token"]').val(data.token);

                    if (data.status) //if success close modal and reload ajax table
                    {
                        Swal.fire({
                            title: "Sucesso",
                            text: "Cliente Alterado Com Sucesso",
                            icon: "success",
                        });
                        $("#modalAlterarCliente").modal('hide');

                        setTimeout(function() {
                            location.reload();
                        }, 1000); 

                    } else {

                        $('[name="mensagem_erro_alteracao"]').addClass('alert alert-danger');
                        $('[name="mensagem_erro_alteracao"]').html(data.erros);

                    }
                },
                error: function(data) {
                    console.log(data);
                    Swal.fire({
                        title: "Erro",
                        text: "Erro Inesperado",
                        icon: "error",
                    });
                    $("#modalAlterarCliente").modal('hide');

                }
            });
        })

        // ************************************************************************
        // EXCLUSÃO DO CLIENTE

        // Clicar no botão de exclusão de uma cliente
        // observe que o botão é inserido dinamicamente na página
        $(document).on("click", "#btExcluir", function() {

            var id = $(this).attr("data-id");
            var nome = $(this).attr("data-nome");

            Swal.fire({
                title: 'Confirma a Exclusão do Cliente?',
                text: nome,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirma Exclusão'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= url('cliente') ?>/" + id,
                        type: "DELETE",
                        dataType: "JSON",
                        success: function(data) {

                            if (data.status) //if success close modal and reload ajax table
                            {
                                Swal.fire({
                                    title: "Sucesso",
                                    text: "Cliente Excluido Com Sucesso",
                                    icon: "success",
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000); 

                            } else {
                                Swal.fire({
                                    title: "Erro",
                                    text: "Erro Inesperado",
                                    icon: "error",
                                });
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                title: "Erro",
                                text: "Erro Inesperado",
                                icon: "error",
                            });
                        }
                    });
                }
            })
        });
    });
</script>