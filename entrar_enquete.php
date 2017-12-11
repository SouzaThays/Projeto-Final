<?php

require_once('controller/ControleProjeto.php');
Projeto('visualizarProjetoEncerrado');

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>

    <?php include('default.php'); ?>
    <?php include('script.php'); ?>

    <script>

        $(function () {


            $("#dialogProjeto").dialog({
                width: "500px",
                modal: true,
                autoOpen: false,
            });

        });


    </script>

</head>

<body class="theme-puc">
    <section>
        <aside id="leftsidebar" class="sidebar">
            <?php include('informacao_participante.php'); ?>
        </aside>
    </section>

    <section class="content">
        <?php include('menu_entrada.php'); ?>

        <div id="idteste"></div>
        <script>
            $(document).ready(function () {
                var $seuCampoCpf = $("#cpf");
                $seuCampoCpf.mask('000.000.000-00', { reverse: true });
            });
        </script>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="card-inside-title">Participe da nossa enquete!</h2>
                        </div>
                        <div class="body">
                            <div class="row">

                                <div class="card">

                                    <div id="msg"></div>

                                    <div class="body">
                                        <p>** Encontre o projeto realizado e acesse a enquete para participar.</p>
                                        
                                        <div id="accordion">
                                            <?php while ($row = mysqli_fetch_array($rs)) { ?>
                                            <h3 class="bg-puc1">
                                                Projeto: <?php echo $row['nome']; ?>
                                            </h3>
                                            <div>
                                                <p>
                                                    <b>Início: </b><?php echo date("d/m/Y", strtotime( $row['dataInicio'])); ?>
                                                    <b>Fim:</b><?php echo date("d/m/Y", strtotime( $row ['dataFim'])); ?>
                                                </p>
                                                <p>
                                                    <b>Local: </b><?php echo $row['local']; ?>
                                                </p>

                                                <?php if($row['certifHC'] == "Sim"){ ?>
                                                <p>
                                                    Atividade válida para horário Complementar.
                                                    <i class="material-icons">card_membership</i>
                                                </p>
                                                <?php }?>

                                                <?php if($row['certifPC'] == "Sim"){ ?>
                                                <p>
                                                    Atividade válida para Projeto Comunirário.
                                                    <i class="material-icons">done</i>
                                                </p>
                                                <?php }?>
												<p>
													<b>Periodo de realização da enquete: </b>
												</p>
                                                <p>
													<b>De </b><?php echo date("d/m/Y", strtotime($row['inicio'])); ?>

													<b>até </b><?php echo date("d/m/Y", strtotime($row['fim'])); ?>
                                                </p>
                                                <br />
                                                <button onclick="btInscrever(<?php echo $row['idProjeto']; ?>)" type="button" class="btn bg-puc waves-effect">RESPONDER</button>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div id="dialogProjeto" title="Inscrição">

        <table id="tbDespesaEditar" class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th colspan="2">CPF</th>
                    <th width="20px">Responder</th>
                </tr>

                <tr>
                    <td colspan="2">
                        <form class="" action="" id="form" name="form" method="post">
                            <input type="text" class="form-control " id="cpf" name="cpf" style="border:0;" placeholder="999.999.999-99" />
                        </form>

                    </td>
                    <td style="display:none">
                        <input type="hidden" id="idDesp" name="idDesp" />
                    </td>
                    <td>
                        <a href="#" title="Incluir" id="linkInscrever">
                            <i class="material-icons" id="add">add_circle_outline</i>
                        </a>
                    </td>
                </tr>

            </tbody>

        </table>
    </div>
</body>
</html>



<script>
            $(function () {
                
                $("#accordion").accordion();

                btInscrever = function (idProj) {
                    
                    $("#dialogProjeto").dialog("open");

                    $('<input/>', {
                        type: 'hidden',
                        name: 'inputProjeto',
                        id: 'inputProjeto',
                        value: idProj
                    }).appendTo('#form');
                };

                //

                $("#add").click(function () {

                    var id = "";
                    var cpf = "";

                    id = document.getElementById('inputProjeto').value;
                    cpf = document.getElementById('cpf').value;

                    var link = document.getElementById('linkInscrever');

                    $.post('enqueteRequire.php?inscricao=incluir&idProjeto&idProjeto=' + id + '&cpf=' + cpf + '', function (resposta) {
                        $("#dialogProjeto").dialog("close");

                        var str = resposta;
                        resposta = str.trim();

                        if (resposta == "1") {
                            window.location.href = "enquete_inscrito.php?cpf=" + cpf + "&idProjeto=" + id;
                           // $("#msg").html('<div class="alert bg-teal alert-dismissible">Você não participou desse projeto</div>');
                        
                        } else {
                            if (resposta == "0") {
                                $("#msg").html('<div class="alert bg-teal alert-dismissible">Não foi encontrada inscrição sua nesse projeto</div>');
                               
                            } else {
                                if (resposta == "-1") {
                                    $("#msg").html('<div class="alert alert-warning alert-dismissible">CPF não encontrado. Faça o cadastro <a href="novo_participante.php">aqui</a></div>');
                                  
                                }
                                if (resposta == "-2") {
                                    $("#msg").html('<div class="alert alert-warning alert-dismissible">Você já respondeu essa enquete</div>');

                                }
                            } 
                        }
                        $('#cpf').val('');

                    });
                    
                });
                


            });

</script>