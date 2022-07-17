<script>
   
    $(document).ready(function() {
        const token = $('#CSRF_token').attr("data-token");

        // INCLUIR NOVA CATEGORIA
        $('#btIncluir').on('click', function() {
    
            $("#nome_categoria").val("");
            $("#mensagem_erro").html("");
            $("#mensagem_erro").removeClass("alert alert-danger")

            $('[name="CSRF_token"]').val(token)

            $("#modalNovaCategoria").modal('show');
        })


        // salvar os dados da inclusão
        $('#btSalvarInclusao').on('click', function() {
            $.ajax({
                url: "<?= url('categoria') ?>", // chama o método para inclusão
                type: "POST",
                data: $('#formInclusao').serialize(), //codifica o formulário como uma string para envio.
                dataType: "JSON",
                success: function(data) {
                    $('[name="CSRF_token"]').val(data.token); // // Update CSRF hash
                    if (data.status) //if success close modal and reload ajax table
                    {  Swal.fire({
                            title: "Sucesso",
                            text: "Categoria Incluída Com Sucesso",
                            icon: "success",
                        });
                        $("#modalNovaCategoria").modal('hide');

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
                    $("#modalNovaCategoria").modal('hide');
                }
            });
        })


        // ************************************************************************
        // ALTERAÇÃO DOS DADOS DA CATEGORIA

        $(document).on("click", "#btAlterar", function() {

            var id = $(this).attr("data-id");
    
            $("#nome_categoria_alteracao").val("");
            $("#mensagem_erro_alteracao").html("");
            $("#mensagem_erro_alteracao").removeClass("alert alert-danger")

            $('[name="CSRF_token"]').val(token)

            $('[name="id_alteracao"]').val(id);

            $("#modalAlterarCategoria").modal('show');
            
        });

        // salvar dados da altercao da categoria
        $('#btSalvarAlteracao').on('click', function() {
            var id = $('[name="id_alteracao"]').attr("value");

            $.ajax({
                url: "<?= url('categoria') ?>" + "/" + id,
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
                            text: "Categoria Alterada Com Sucesso",
                            icon: "success",
                        });
                        $("#modalAlterarCategoria").modal('hide');

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
                    $("#modalAlterarCategoria").modal('hide');

                }
            });
        })

        // ************************************************************************
        // EXCLUSÃO DA CATEGORIA

        // Clicar no botão de exclusão de uma categoria
        // observe que o botão é inserido dinamicamente na página
        $(document).on("click", "#btExcluir", function() {

            var id = $(this).attr("data-id");
            var nome = $(this).attr("data-nome");

            Swal.fire({
                title: 'Confirma a Exclusão da Categoria?',
                text: nome,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirma Exclusão'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= url('categoria') ?>/" + id,
                        type: "DELETE",
                        dataType: "JSON",
                        success: function(data) {

                            if (data.status) //if success close modal and reload ajax table
                            {
                                Swal.fire({
                                    title: "Sucesso",
                                    text: "Categoria Excluida Com Sucesso",
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