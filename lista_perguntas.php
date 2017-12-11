<?php include('menu.php'); ?>

<?php
require_once('controller/ControleEnquete.php');
Enquete('consultarPerguntasInseridas');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>


    <script>

        $(function () {


            $("#dialogDadosAlternativa").dialog({
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
            <?php include('informacao.php'); ?>
        </aside>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Lista de Perguntas
                            </h2>
                        </div>
                        <div class="body">
                           
                            <?php while ($row3 = mysqli_fetch_array($rs)) { ?>

                            <div>
                                <div class="form-line">
                                    <input type="hidden" class="form-control " name="idProjeto" id="idProjeto" value="<?php echo $row3['idProjeto']; ?>" required />
                                </div>
                            </div>
                            <?php  }?>


                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable ">
                                    <thead>
                                        <tr>
                                            <th>Perguntas</th>
                                            <th width="10">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($rsPergunta)) { ?>
                                        <tr>
                                          

											<td><?php echo $row['descricao']; ?>
											</td>
                                        
                                            <td>
                                                    <i class="material-icons" title="Excluir" style="cursor:pointer;" onclick="abreDados(<?php echo $row['idPerguntas']; ?>)">delete_forever</i>
                                                   
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

</body>
</html>


<div id="dialogDadosAlternativa" title="Excluir Alternativa">

	<div id="conteudo"></div>

</div>

<script>

    (function () {

        abreDados = function (id) {
            var idProjeto = $('#idProjeto').val();
            $.post('dados_Alternativa.php?idPergunta=' + id + '&idProjeto=' + idProjeto + '', function (tabela) {
                $("#conteudo").html(tabela);
                $("#dialogDadosAlternativa").dialog("open");
            });
        }

        fechar = function () {
            $("#dialogDadosAlternativa").dialog("close");
        }


        RemoveTableRow = function (handler) {

            var tr = $(handler).closest('tr');
            vId = tr.find('#idAlt').val();
            alert(vId);

            tr.fadeOut(400, function () {
                $('<input/>', {
                    type: 'hidden',
                    name: 'fkEnquete',
                    value: vId
                }).appendTo('#form');
               
                $.post('dados_Alternativa.php?excluir=ok&idEnquete=' + vId + '', function (tabela) {
                  
                });
                tr.remove();
            });

            return false;
        };


    })(jQuery);

</script>