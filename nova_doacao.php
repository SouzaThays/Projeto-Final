<?php
require_once('controller/ControleDoacao.php');
Doacao('incluir');
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
                            <h2 class="card-inside-title">Novo Doação</h2>
                        </div>
                        <div class="body">
                            <form id="conteudo">
                                <div class="demo-masked-input">
                                    <div class="row clearfix"><?php
                                require_once('controller/ControleEscola.php');
                                Escola('consultar');
                                ?>

                                        <div class="col-md-6">
                                            <b>Escola</b>

                                            <select class="form-control show-tick" id="fkEscola" name="fkEscola">
                                                <option value="-1">Selecionar</option><?php while ($row1 = mysqli_fetch_array($rsEscola)) { ?>
                                                <option value="<?php echo $row1['idEscola']; ?>"><?php echo $row1['nome']; ?> </option><?php } ?>
                                            </select>
                                        </div><?php
                                require_once('controller/ControleBeneficiario.php');
                                Beneficiario('consultar');
                                ?>
                                        <div class="col-md-6">
                                            <b>Beneficiário</b>
                                            <div class="form-line">
                                                <select class="form-control show-tick" id="fkBeneficiario" name="fkBeneficiario">
                                                    <option value="-1">Selecionar</option><?php while ($row2 = mysqli_fetch_array($rsBeneficiario)) { ?>
                                                    <option value="<?php echo $row2['idBeneficiario']; ?>"><?php echo $row2['nome']; ?> </option><?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>


                              <?php
                              require_once('controller/ControleDonativo.php');
                              Donativo('consultar');
                              ?>

                                <b>Donativos</b>
                                <table id="tbDoacao" class="table-bordered table-striped table-hover" >
                                    <tbody><?php while ($row2 = mysqli_fetch_array($rsDonativo)) { ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="idDonativo<?php echo $row2['idDonativo']; ?>" name="idDonativo" value="<?php echo $row2['idDonativo']; ?>" />
                                                <label for="idDonativo<?php echo $row2['idDonativo']; ?>"><?php echo $row2['nome']; ?></label>
                                                <input type="hidden" name="idDonat" id="idDonat" value="<?php echo $row2['idDonativo']; ?>" />
                                            </td>
                                            <td>
                                                

                                                <div class="col-md-12">
                                                    <div class="form-line">
                                                        <input type="number" id="quantidadeDonativo" name="quantidadeDonativo" value="" min="0" />
                                                    </div>
                                                </div>


                                        </tr><?php } ?>
                                    </tbody>

                                </table>
                                <br />
                                <div class="button-demo">
                                    <input type="button" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn bg-puc waves-effect" onclick="cadastrar()" />
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
                strDon = "idDonativo" + idDon;

                qtd = $(this).find('#quantidadeDonativo').val();

                if ($("#" + strDon).is(':checked')) {

                    $('<input/>', {
                        type: 'hidden',
                        name: 'ListaidDonat[]',
                        value: idDon
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

        $.post('nova_doacao.php?cria=ok', $form.serialize(), function (resposta) {
               alert("Cadastrado com sucesso !");
        });
        window.location = "lista_doacao.php?pg=listaDoacao";


        }
</script>