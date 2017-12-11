<?php include('menu.php'); ?>

<?php
$vidBeneficiario= $_GET['idBeneficiario'];
if(empty($vidBeneficiario)){
    require_once('controller/ControleBeneficiario.php');
    Beneficiario('incluir');
}else{
    require_once('controller/ControleBeneficiario.php');
Beneficiario('editar');}

?>



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
                            <h2 class="card-inside-title">Novo Beneficiado</h2>
                        </div>
                        <script src="view/js/Validacaoform.js"></script>
                        <div class="body">
                            <form class="form_advanced_validation" action="" id="form" name="form" method="post">
                                <?php  if(empty($vidBeneficiario)){ ?>

                                <div class="demo-masked-input">
                                    <div class="row clearfix">
                                        <div class="col-md-5">
                                            <b>Nome*</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nome" placeholder="Nome completo" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Telefone*</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control telFixo" id="telefoneFixo" name="telefoneFixo" placeholder="(041)3333-33-33" required/ />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <b>Responsável*</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control " name="nomeResponsavel" placeholder="Nome completo" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <b>Endereço*</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control " name="endereco" placeholder="Ex: Rua São Lucas, 479" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-demo">
                                        <input type="submit" name="button" id="button" value="Cadastrar" class="btn btn-danger waves-effect" onclick="validaData()" />
                                        <input type="hidden" name="ok" id="ok" />
                                    </div>
                                </div>



                                <!------------------------------------------------EDITAR------------------------------------------------------->
								<?php  } else{ ?>
								<?php while ($row3 = mysqli_fetch_array($rs)) { ?>
                                <div class="demo-masked-input">
                                    <div class="row clearfix">
                                        <div class="col-md-5">
                                            <b>Nome*</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nome" placeholder="Nome completo" value="<?php echo $row3['nome']; ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Telefone*</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control telFixo" name="telefoneFixo" id="telefoneFixo" placeholder="(041)3333-33-33" value="<?php echo $row3['telefone']; ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <b>Responsável*</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control " name="nomeResponsavel" placeholder="Nome completo" value="<?php echo $row3['nomeResponsavel']; ?>" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <b>Endereço*</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control " name="endereco" placeholder="Ex: Rua São Lucas, 479" value="<?php echo $row3['endereco']; ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-demo">
                                        <input type="submit" name="button" id="button" value="Cadastrar" class="btn btn-danger waves-effect" onclick="validaData()" />
                                        <input type="hidden" name="ok" id="ok" />
                                    </div>
                                </div>
                                <?php  } 
                                   }
								?>

                             
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>



