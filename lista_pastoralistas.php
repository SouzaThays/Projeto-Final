<?php include('menu.php'); ?>

<?php
require_once('controller/ControlePastoralista.php');
Pastoralista('consultar');
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
                                Lista de Pastoralistas
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>

                                            <th>Matricula</th>
                                            <th>Login</th>
											<th>Status</th>
                                            <th>Ação</th>
                                            
                                           
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($rs)) { ?>
                                        <tr>

                                            <td><?php echo $row['matricula']; ?></td>
                                            <td><?php echo $row['login']; ?></td>
                                            <td>
                                                <?php echo $row['status']; ?>
                                            </td>
                                            <td>
                                                <a href="novo_pastoralista.php?pg=novoPast&ok=true&login=<?php echo $row['login']; ?>">
                                                    <i class="material-icons">edit</i>
                                                </a>
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

  

</script>