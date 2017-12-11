<?php include('menu.php'); ?>

<?php
require_once('controller/ControleDonativo.php');
Donativo('consultar');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>

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
                                Lista de Donativos
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>

                                            <th>Item</th>
                                            <th>Pontuação</th>
                                            <th width="10">Ação</th>
                                           
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($rsDonativo)) { ?>
                                        <tr>
                                            <td><?php echo $row['nome']; ?></td>
                                            <td><?php echo $row['pontuacao']; ?></td>
                                            <td>
                                                <a href="novo_donativo.php?idDonativo=<?php echo $row['idPergunta']; ?>">
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
        </div>
    </section>

</body>
</html>


<script>

    (function () {


    })(jQuery);

</script>