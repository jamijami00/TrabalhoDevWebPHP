<script>
   
    $(document).ready(function() {
        const token = $('#CSRF_token').attr("data-token");

        // INCLUIR NOVO FUNCIONARIO
        $('#btIncluir').on('click', function() {
    
            $("#nome").val("");
            $("#cpf").val("");
            $("#senha").val("");
            $("#papel").val("");
            $("#mensagem_erro").html("");
            $("#mensagem_erro").removeClass("alert alert-danger")

            $('[name="CSRF_token"]').val(token)

            $("#modalNew").modal('show');
        })


        // salvar os dados da inclusão
        $('#btSalvarInclusao').on('click', function() {
            $.ajax({
                url: "<?= url('funcionario') ?>", // chama o método para inclusão
                type: "POST",
                data: $('#formInclusao').serialize(), //codifica o formulário como uma string para envio.
                dataType: "JSON",
                success: function(data) {
                    $('[name="CSRF_token"]').val(data.token); // // Update CSRF hash
                    if (data.status) //if success close modal and reload ajax table
                    {  Swal.fire({
                            title: "Sucesso",
                            text: "Funcionario Incluído Com Sucesso",
                            icon: "success",
                        });
                        $("#modalNew").modal('hide');

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
                    $("#modalNew").modal('hide');
                }
            });
        })


        // ************************************************************************
        // ALTERAÇÃO DOS DADOS DO FUNCIONARIO

        $(document).on("click", "#btAlterar", function() {

            var id = $(this).attr("data-id");
    
            $("#nome_alteracao").val("");
            $("#cpf_alteracao").val("");
            $("#senha_alteracao").val("");
            $("#papel_alteracao").val("");
            $("#mensagem_erro_alteracao").html("");
            $("#mensagem_erro_alteracao").removeClass("alert alert-danger")

            $('[name="CSRF_token"]').val(token)

            $('[name="id_alteracao"]').val(id);

            $("#modalEdit").modal('show');
            
        });

        // salvar dados da altercao da funcionario
        $('#btSalvarAlteracao').on('click', function() {
            var id = $('[name="id_alteracao"]').attr("value");

            $.ajax({
                url: "<?= url('funcionario') ?>" + "/" + id,
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
                            text: "Funcionario Alterado Com Sucesso",
                            icon: "success",
                        });
                        $("#modalEdit").modal('hide');

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
                    $("#modalEdit").modal('hide');

                }
            });
        })

        // ************************************************************************
        // EXCLUSÃO DO FUNCIONARIO

        // Clicar no botão de exclusão de uma funcionario
        // observe que o botão é inserido dinamicamente na página
        $(document).on("click", "#btExcluir", function() {

            var id = $(this).attr("data-id");
            var nome = $(this).attr("data-nome");

            Swal.fire({
                title: 'Confirma a Exclusão do Funcionario?',
                text: nome,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirma Exclusão'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= url('funcionario') ?>/" + id,
                        type: "DELETE",
                        dataType: "JSON",
                        success: function(data) {

                            if (data.status) //if success close modal and reload ajax table
                            {
                                Swal.fire({
                                    title: "Sucesso",
                                    text: "Funcionario Excluido Com Sucesso",
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