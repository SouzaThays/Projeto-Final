<?php include('menu.php'); ?>

<?php
require_once('controller/ControleDoacao.php');
Doacao('consultar');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>

    <script>

        $(function () {


            $("#dialogDadosDoacao").dialog({
                width: "700px",
                modal: true,
                autoOpen: false,
            });

        });


    </script>

</head>

<body class="theme-puc">
    <section>
        <aside id="leftsidebar" class="sidebar"><?php include('informacao.php'); ?>
        </aside>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Lista de Doações
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>

                                            <th>Data</th>
                                            <th>Pontuação</th>
                                            <th>Quantidade</th>
                                            <th>Escola</th>
                                            <th width="10">Itens</th>
                                           
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($rs)) { ?>
                                        <tr>

                                            <td><?php echo date("d/m/Y", strtotime( $row['data'])); ?></td>
                                            <td><?php echo $row['pontuacao']; ?></td>
                                            <td>
                                                <?php echo $row['quantidade']; ?>
                                            </td>
                                            <td><?php echo $row['nome']; ?></td>
                                            <td>
                                                <i class="material-icons" style="cursor:pointer;" onclick="abreDados(<?php echo $row['id']; ?>)">sort</i>
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
        </div>
    </section>

</body>
</html>


<div id="dialogDadosDoacao" title="Detalhes da Doação">

    <div id="conteudo"></div>

</div>

<script>

    (function () {

        abreDados = function (id) {
           
            $.post('dados_doacao.php?listarItens=ok&idDoacao=' + id + '', function (tabela) {
                $("#conteudo").html(tabela);
                $("#dialogDadosDoacao").dialog("open");
            });
        }

        fechar = function () {
            $("#dialogDadosDoacao").dialog("close");
        }


    })(jQuery);

</script>