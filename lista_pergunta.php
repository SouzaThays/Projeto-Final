<?php include('menu.php'); ?>

<?php
require_once('controller/ControleEnquete.php');
Enquete('consultarPergunta');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>
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
                                            <td>
                                                <?php echo $row['descricao']; ?>
                                            </td>
                                            <td>
                                              
                                                    <a href="lista_pergunta.php?excluir=ok&idPergunta=<?php echo $row['idPerguntas']; ?>">
                                                        <i class="material-icons" title="Excluir">delete_forever</i>
                                                    </a>
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