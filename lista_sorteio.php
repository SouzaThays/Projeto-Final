<?php include('menu.php'); ?>

<?php
require_once('controller/ControleSorteio.php');
Sorteio('consultar');

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
                                            <th>Data Inicio</th>
                                            <th>Data Fim</th>
                                            <th>Prêmio</th>
                                            <th>Regra</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($rs)) { ?>
                                        <tr>
                                            <td>
                                                <?php echo date("d/m/Y", strtotime( $row['dataInicio'])); ?>
                                            </td>
                                            <td>
                                                <?php echo date("d/m/Y", strtotime( $row['dataFim'])); ?>
                                            </td>
                                            <td>
                                                <?php echo $row['premio']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['regra']; ?>
                                            </td>
											
                                            <td>
                                               
                                                <a href="lista_pergunta.php?excluir=ok&idSorteio=<?php echo $row['idSorteio']; ?>">
                                                    <i class="material-icons" title="Excluir">delete_forever</i>
                                                </a>
                                                <a href="novo_sorteio.php?pg=sorteio&idSorteio=<?php echo $row['idSorteio']; ?>" title="Editar">
                                                    <i class="material-icons">edit</i>
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