<?php
require_once('controller/ControleInscrito.php');
Inscrito('consultarInscritoPorProjeto');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>


    <script>
            $(function () {
                $("#dialog").dialog();
            });
    </script>

</head>

<body class="theme-puc">
    <section>
        <aside id="leftsidebar" class="sidebar">
            <?php include('informacao.php'); ?>
        </aside>
    </section>

    <section class="content">
        <?php include('menu.php'); ?>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="card-inside-title">Lista de Inscrito</h2>
                        </div>
                        <div class="body">
                            <form id="conteudo">
                               
                            </form>
                            <table id="tbDoacao" class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>CPF</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php while ($row2 = mysqli_fetch_array($rs)) { ?>
                                    <tr>

                                        <td>
                                            <input type="checkbox" id="idDonativo<?php echo $row2['idInscrito']; ?>" name="idDonativo" value="<?php echo $row2['idInscrito']; ?>" />
                                            <label for="idDonativo<?php echo $row2['idInscrito']; ?>">
                                                <?php echo $row2['email']; ?>
                                            </label>
                                            <input type="hidden" name="idDonat" id="idDonat" value="<?php echo $row2['idInscrito']; ?>" />
                                            <input type="hidden" name="email" id="email" value="<?php echo $row2['email']; ?>" />
                                            <input type="hidden" name="nome" id="nome" value="<?php echo $row2['nome']; ?>" />
                                            <input type="hidden" name="projeto" id="projeto" value="<?php echo $row2['nome']; ?>" />
                                        </td>

                                        <td>
                                            <?php echo $row2['cpf']; ?>
                                        </td>



                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                                <br />
                                <div class="button-demo">
                                    <input type="button" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn btn-danger waves-effect" onclick="cadastrar()" />
                                </div>

                                
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>

<script>


    cadastrar = function () {

        var check = document.getElementsByName("idDonativo");

        $('#tbDoacao').find('tr').each(function (indice) {
            $(this).find('td').each(function (indice) {

                idDon = $(this).find('#idDonat').val();
                email = $(this).find('#email').val();
                nome = $(this).find('#nome').val();
                projeto = $(this).find('#projeto').val();
                strDon = "idDonativo" + idDon;

                qtd = $(this).find('#quantidadeDonativo').val();

                if ($("#" + strDon).is(':checked')) {
                    alert(strDon);

                    $('<input/>', {
                        type: 'hidden',
                        name: 'ListaId[]',
                        value: idDon
                    }).appendTo('#conteudo');


                    $('<input/>', {
                        type: 'hidden',
                        name: 'ListaEmail[]',
                        value: email
                    }).appendTo('#conteudo');


                    $('<input/>', {
                        type: 'hidden',
                        name: 'ListaNome[]',
                        value: nome
                    }).appendTo('#conteudo');

                    $('<input/>', {
                        type: 'hidden',
                        name: 'ListaProjeto[]',
                        value: projeto
                    }).appendTo('#conteudo');
                }

                if (qtd > 0) {

                    $('<input/>', {
                        type: 'hidden',
                        name: 'ListaQtd[]',
                        value: qtd
                    }).appendTo('#conteudo');

                }

            });
        });

        var $form = $('#conteudo');

        $.post('lista_inscrito_proj_encerrados.php?cria=email', $form.serialize(), function (resposta) {
            alert("Cadastrado com sucesso !");
      });
      


        }
</script>