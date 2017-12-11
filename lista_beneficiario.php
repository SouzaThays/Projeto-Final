<?php include('menu.php'); ?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>
    <script>
        $(document).ready(function () {
           
            var $tel = $("#telefoneFixo");
            $tel.mask('(000)0000-0000', { reverse: false });

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
        <?php include('menu.php'); ?>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="card-inside-title">Novo Beneficiario</h2>
                        </div>
                        <script src="view/js/Validacaoform.js"></script>
                        <div class="body">
                            <form class="form_advanced_validation" action="" id="form" name="form" method="post">
                               

                                <?php
                                require_once('controller/ControleBeneficiario.php');
                                Beneficiario('consultar');
								?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable ">
                                        <thead>
                                            <tr>
                                                <th>Beneficiário</th>
                                                <th>Endereço</th>
                                                <th>Telefone</th>
                                                <th>Responsável</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($rsBeneficiario)) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['nome']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['endereco']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['telefone']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['nomeResponsavel']; ?>
                                                </td>
                                                <td>
                                                    <a href="novo_beneficiario.php?pg=novoBen&idBeneficiario=<?php echo $row['idBeneficiario']; ?>">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <a href="novo_beneficiario.php?ok=excluir&idBeneficiario=<?php echo $row['idBeneficiario']; ?>">
                                                        <i class="material-icons">delete_forever</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php }?>



                                        </tbody>
                                    </table>
                                </div>
                             
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>



