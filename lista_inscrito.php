<?php include('menu.php'); ?>

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

            $("#dialogDadosPessoais").dialog({
                width: "800px",
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
                                Lista de Inscritos
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>

                                            <th>Name</th>
                                            <th>Data inscrição</th>
                                            <th>CPF</th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($rs)) { ?>
                                        <tr>

                                            <td><?php echo $row['nome']; ?></td>
                                            <td><?php echo date("d/m/Y", strtotime( $row['dataInscricao'])); ?></td>
                                            <td><?php echo $row['cpf']; ?></td>
                                            <td>
                                                <i class="material-icons" style="cursor:pointer;" onclick="abreDados(<?php echo $row['idUsuario']; ?>)">account_circle</i>
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


<div id="dialogDadosPessoais" title="Dados Pessoais">

    <div id="conteudo"></div>

</div>

<script>

    (function () {

        abreDados = function (id) {

            $.post('dados_pessoais.php?idPessoa=' + id + '', function (tabela) {
                $("#conteudo").html(tabela);
                $("#dialogDadosPessoais").dialog("open");
            });
        }

        fechar = function () {
            $("#dialogDadosPessoais").dialog("close");
        }

    })(jQuery);

</script>