<?php

require_once('controller/ControleFaq.php');
Faq('consultar');

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
 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="card-inside-title">Dúvidas Frequentes</h2>
                        </div>
                        <div id="msg"></div>
                        <div class="body">
                            <div class="row">                             
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                 
                                  
                                    <!--<button onclick="btInscrever(<?php echo $row['idProjeto']; ?>)" type="button" class="btn bg-puc1 waves-effect">ENVIAR DÚVIDA</button>-->

                                    <div id="accordion">
                                        <?php while ($row = mysqli_fetch_array($rs)) { ?>
                                        <h3 class="bg-puc1">
                                            <?php echo $row['pergunta']; ?>
                                        </h3>
                                        <div>
                                            <p>
                                                <b>Resposta: </b><?php echo $row['resposta']; ?>
                                            </p>
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


    </section>

    <div id="dialogProjeto" title="FAQ - DÚVIDA" >

        <table id="tbDespesaEditar" class="table table-bordered table-striped table-hover">
            <tbody>
              

                <tr>
                    <td colspan="2">
                        <form class="" action="" id="form" name="form" method="post">
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <b>Nome</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control " id="nome" name="nome" style="border:0;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <b>Dúvida</b>
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
                    nome = document.getElementById('nome').value;
                    mensagem = document.getElementById('mensagem').value;


                    var link = document.getElementById('linkDepoimento');

                    $.post('faqRequire.php?enviar=email&nome=' + nome + '&mensagem=' + mensagem + '', function (resposta) {
                        $("#dialogProjeto").dialog("close");

                        var str = resposta;
                        resposta = str.trim();

                        if (resposta == "1") {
                            $("#msg").html('<div class="alert bg-green alert-dismissible">Enviado com sucesso</div>');
   
                        } else {
                            if (resposta == "0") {
                                $("#msg").html('<div class="alert bg-teal alert-dismissible">Falha no envio de E-mail</div>');
                            }
                        }
                        $('#cpf').val('');

                    });
                });


            });

</script>