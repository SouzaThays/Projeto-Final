

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>
</head>

<body class="theme-puc">
    <?php  include('menu.php'); ?>

    <section>

        <aside id="leftsidebar" class="sidebar">

            <?php include('informacao.php'); ?>


        </aside>


        <?PHP
        require_once('controller/ControlePessoa.php');
        ProcessoPessoa('contarPessoa');


        require_once('controller/ControleDepoimento.php');
        Depoimento('consultarEnviado');
        ?>

    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">PROJETO</div>
                            <?php $row2 = mysqli_fetch_array($rsContPR) ;?>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
                                <?php echo $row2['COUNT(*)'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text">BENEFICIÁRIO</div>
                            <?php $row3 = mysqli_fetch_array($rsContB) ;?>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
                                <?php echo $row3['COUNT(*)'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">DEPOIMENTO</div>
                            <?php $row1 = mysqli_fetch_array($rsContD) ;?>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">
                                <?php echo $row1['COUNT(*)'] ?>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">PESSOA</div>
                            <?php $row = mysqli_fetch_array($rsContP) ;?>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">
                                <?php echo $row['COUNT(*)'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-teal">
                        <div class="font-bold m-b--35">QUANTIDADE DE INSCRIÇÃO POR PROJETO</div>
                        <ul class="dashboard-stat-list">
                            <?php while($row5 = mysqli_fetch_array($rsContPI)) {?>
                            <li>
                                <?php echo $row5['nome'] ?>
                                <span class="pull-right">
                                    <b>
                                        <?php echo $row5['quantidade'] ?>
                                    </b>
                                    <small>INSCRITO</small>
                                </span>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="header">
                        <h2>DEPOIMENTOS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>

                                        <th>Nome</th>
                                        <th>Status</th>
                                        <th>Mensagem</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row6 = mysqli_fetch_array($rsDepoimento)) {?>
                                    <tr>

                                        <td>
                                            <?php echo $row6['nome'] ?>
                                        </td>
                                        <td>
                                            <span class="label bg-green">
                                                <?php echo $row6['status'] ?>
                                            </span>
                                        </td>
                                        <td><?php echo $row6['mensagem'] ?></td>

                                    </tr>
                                    <?php }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
    </section>
</body>

</html>





