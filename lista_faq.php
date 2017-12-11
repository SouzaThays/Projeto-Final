<?php include('menu.php'); ?>

<?php
require_once('controller/ControleFaq.php');
Faq('consultar');
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
                                FAQ
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable ">
                                    <thead>
                                        <tr>
                                            <th>FAQ</th>                                  
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($rs)) { ?>
                                        <tr>
                                            <td>
                                                <b>Pergunta:</b>
<br />
                                                <?php echo $row['pergunta'];?>
                                                <br />
                                                <b>Resposta:</b>
<br />
                                                <?php echo $row['resposta'];?>
												
                                            </td>
                                            <td>
                                                <a href="editar_faq.php?ok=true&idFaq=<?php echo $row['idFAQ']; ?>">
                                                    <i class="material-icons">edit</i>
                                                </a>

                                                <a href="lista_faq.php?ok=true&idFaq=<?php echo $row['idFAQ']; ?>">
                                                    <i class="material-icons">delete</i>
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