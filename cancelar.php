<?php
require_once('controller/ControleInscrito.php');
Inscrito('consultExcluir');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>


	<script>
       
            $(document).ready(function () {
                var $seuCampoValor = $("#CPF");
            $seuCampoValor.mask('000.000.000-00', {
                reverse: true,

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
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="card-inside-title">Cancelar Inscrição</h2>
                        </div>
                        <div class="body">
                            
                                

                                <p>
                                    <b>**Realize o cancelamento com o CPF utilizando na inscrição.</b>
                                </p>
                                <br />
                                
                            <b>CPF</b>
                            <table class="table" border="0">
                                <tr>
                                    <th>
                                        <form id="conteudo">
                                            <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF" />
                                        </form>
                                    </th>
                                    <th>
                                        <i class="material-icons" style="cursor:pointer;" onclick="pesquisarFiltro()">search</i>
                                    </th>
                                </tr>

                            </table>


                            <div id="lista"></div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>

<script>

        pesquisarFiltro = function () {

            var $form = $('#conteudo');

            $.post('lista_inscricoes.php', $form.serialize(), function (lista) {
                $("#lista").html(lista);
            });
        }

        excluirId = function (id) {

            $.post('cancelarRequire.php?cancel=ok&idEx=' + id + '', function (resposta) {

                var str = resposta;
                resposta = str.trim();

                alert(resposta);

                if (resposta == "0") {
                    $("#lista").html('<div class="alert bg-green alert-dismissible">Inscrição cancelada com sucesso</div>');
                }
                    
            });

        }

</script>