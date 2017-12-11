<?php

require_once('controller/ControleProjeto.php');
Projeto('consultar');

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
                            <h2 class="card-inside-title">Envie um depoimento sobre as atividades da OEP</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="card">
                                    <div id="msg"></div>
                                    <div class="body">
                                        <div id="accordion">
                                            <?php while ($row = mysqli_fetch_array($rs)) { ?>
                                            <h3 class="bg-puc1">
                                                Projeto: <?php echo $row['nome']; ?>
                                            </h3>
                                            <div>
                                                <p>
                                                    <b>Início: </b><?php echo date("d/m/Y", strtotime( $row['dataInicio'])); ?>
                                                    <b>Fim:</b><?php echo date("d/m/Y", strtotime( $row['dataFim'])); ?>
                                                </p>       
                                                <p>
                                                    <b>Local: </b><?php echo $row['local']; ?>
                                                </p>
												<p>
													<b>Informação: </b><?php echo $row['informacao']; ?>
												</p>
								
                                                <br />
												<button onclick="btInscrever(<?php echo $row['idProjeto']; ?>)" type="button" class="btn bg-puc waves-effect">ENVIAR</button>
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

    <div id="dialogProjeto" title="Depoimento" >

        <table id="tbDespesaEditar" class="table table-bordered table-striped table-hover">
            <tbody>
              

                <tr>
                    <td colspan="2">
                        <form class="" action="" id="form" name="form" method="post">
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <b>CPF</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control " id="cpf" name="cpf" style="border:0;" placeholder="999.999.999-99" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <b>Depoimento</b>
                                        <div>
                                            <div class="form-line">
                                                <textarea rows="5" class="form-control auto-growth" placeholder="..." id="mensagem" name="mensagem" title="Escreva um depoimento" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div style="height:10px"></div>
                        <button href="#" title="Incluir" class="btn bg-puc waves-effect col-md-12" id="linkDepoimento">
                            <i class="material-icons" id="add">done</i>
                            <span>ENVIAR</span>
                        </button>
                    </td>
                    <td style="display:none">
                        <input type="hidden" id="idDesp" name="idDesp" />
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

                $("#linkDepoimento").click(function () {

                    var id = "";
                    var cpf = "";
                    var mensagem = "";

                    id = document.getElementById('inputProjeto').value;
                    cpf = document.getElementById('cpf').value;
                    mensagem = document.getElementById('mensagem').value;


                    var link = document.getElementById('linkDepoimento');

                    $.post('depoimentoRequire.php?inscricao=incluir&cpf=' + cpf + '&mensagem=' + mensagem + '', function (resposta) {
                        $("#dialogProjeto").dialog("close");

                        var str = resposta;
                        resposta = str.trim();

                        if (resposta == "1") {
                            $("#msg").html('<div class="alert bg-green alert-dismissible">Enviado com sucesso</div>');
   
                        } else {
                            if (resposta == "0") {
                                $("#msg").html('<div class="alert bg-teal alert-dismissible">Você já possui inscrição para esta atividade</div>');
                            } else {
                                if (resposta == "-1") {
                                    $("#msg").html('<div class="alert alert-warning alert-dismissible">CPF não encontrado.</div>');
                                }
                            }
                        }
                        $('#cpf').val('');

                    });
                });


            });

</script>