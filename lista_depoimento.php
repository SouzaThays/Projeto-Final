<?php include('menu.php'); ?>

<?php
require_once('controller/ControleDepoimento.php');
Depoimento('consultar');

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
                                Depoimento
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable ">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Depoimento</th>
                                            <th>Data envio</th>
                                            <th>Status</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($rsDepoimento)) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['nome']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['mensagem']; ?>
                                            </td>
                                            <td>
                                                <?php echo date("d/m/Y", strtotime( $row['dataEnvio'])); ?>
                                            </td>
                                            <td>
                                                <?php echo $row['status']; ?>
                                            </td>
											
                                            <td>
                                               
                                                <a href="lista_depoimento.php?pg=depoimento&editar=aceito&idDepoimento=<?php echo $row['iddepoimento']; ?>">
                                                    <i class="material-icons">check</i>
                                                </a>
                                                <a href="lista_depoimento.php?pg=depoimento&ok=excluir&idDepoimento=<?php echo $row['iddepoimento']; ?>">
                                                    <i class="material-icons">cancel</i>
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