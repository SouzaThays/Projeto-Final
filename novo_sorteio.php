<?php 
$vidProjeto = $_GET['idProjeto'];

if(empty($vidProjeto)){
    require_once('controller/ControleSorteio.php'); 
    Sorteio('incluir');  
}else{
    require_once('controller/ControleProjeto.php'); 
    Projeto('editar');         
}

?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
		
        <?php include('default.php'); ?>
        <?php include('script.php'); ?>
	
		<script>

            $(function () {

             



                $(document).ready(function () {
                    var $valorTaxa = $("#valorTaxa");
                    $valorTaxa.mask('00000,00', { reverse: true });

                    var $data = $("#dataInicio");
                    $data.mask('00/00/0000', { reverse: false });

                    var $dataFim = $("#dataFim");
                    $dataFim.mask('00/00/0000', { reverse: false });

                    var $despesa = $("#valorDesp");
                    $despesa.mask('00000,00', { reverse: true });
                });


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
                        <h2 class="card-inside-title">Novo Sorteio</h2>
                    </div>


                    <div class="body">
                        <form class="form_advanced_validation" action="" id="form" name="form" method="post">
                            <?php  if(empty($vidProjeto)){ ?>
                            <div id="msg"></div>
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-5">
                                        <?php
                                       require_once('controller/ControleProjeto.php');
                                       Projeto('consultarPInscricao');
										?>

                                            <b>Projeto</b>

                                        <select class="form-control show-tick" id="fkProjeto" name="fkProjeto"><?php while ($row1 = mysqli_fetch_array($rs)) { ?>
                                            <option value="<?php echo $row1['idProjeto']; ?>"><?php echo $row1['nome']; ?></option><?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

							<div class="demo-masked-input">
								<div class="row clearfix">
									<div class="col-md-2">
										<b>Data inicio *</b>
										<div>
											<div class="form-line">
												<input type="text" class=" date form-control " id="dataInicio" name="dataInicio" placeholder="01/01/2017" required>
											</div>
										</div>

									</div>
									<div class="col-md-2">
										<b>Data fim *</b>
										<div>
											<div class="form-line">
												<input type="text" class="form-control date" id="dataFim" name="dataFim" placeholder="01/01/2017" required>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<b>Premio</b>
										<div>
											<div class="form-line">
												<input type="text" class="form-control " id="premio" name="premio" placeholder="Prêmio" min="0">
											</div>
										</div>
									</div>

									<div class="col-sm-5">
										<b>Regra</b>
										<div>
											<div class="form-line">
												<input type="text" class="form-control auto-growth" placeholder="..." id="regra" name="regra">
											</div>
										</div>
									</div>

									<div class="button-demo">
										<input type="submit" name="button" id="button" value="Cadastrar" class="btn bg-puc waves-effect" onclick="validaData()" />
										<input type="hidden" name="ok" id="ok" />
									</div>
								</div>

							</div> 

                            <!------------------------------------------------------------------ ATUALIZAR-----------------------------------------------------------------><?php
                                   }else{
                                       while ($row1 = mysqli_fetch_array($rs)) {
																																											?>

                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-5"><?php
                                           require_once('controller/ControlePrograma.php');
                                           Programa('consultar');
														  ?>
                                        <p>
                                            <b>Projeto</b>
                                        </p>
                                        <select class="form-control show-tick" id="fkprograma" name="fkprograma"><?php
                                           $idProg =  $row1['fkprojeto'];
                                           $vSelected = "selected";
                                           while ($row3 = mysqli_fetch_array($rsPrograma)) { ?>
                                            <option value="<?php echo $row3['idprojeto'];?>"
                                                    <?php if($idProg == $row3['idprojeto']){
                                                              echo $vSelected;
                                                          }?>>
                                            <?php echo $row3['nome']; ?>
                                            </option><?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-5">

                                    </div>
                                </div>
                            </div>
								<div class="demo-masked-input">
									<div class="row clearfix">
										<div class="col-md-2">
											<b>Data inicio</b>
											<div>
												<div class="form-line">
													<input type="text" class=" date form-control " id="dataInicio" name="dataInicio" placeholder="01/01/2017" value="<?php echo date("d/m/Y", strtotime($row1['dataInicio'])); ?>">
												</div>
											</div>

										</div>
										<div class="col-md-2">
											<b>Data fim</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control date" id="dataFim" name="dataFim" placeholder="01/01/2017" value="<?php echo date("d/m/Y", strtotime($row1['dataFim'])); ?>">
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<b>Prêmio</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control " id="premio" name="premio" placeholder="Número" min="0" value="<?php echo $row1['premio']; ?>">
												</div>
											</div>
										</div>

										<div class="col-sm-5">
											<b>Regra</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control auto-growth" placeholder="..." id="regra" name="regra" value="<?php echo $row1['regra']; ?>">
												</div>
											</div>
										</div>
									</div>
								
                            </div><?php
                                       }
                                   } ?>

                            <input type="hidden" name="okExcluir" id="okExcluir" value="" />
                            <input type="hidden" name="okExcluirEd" id="okExcluirEd" value="" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

<script>


	</script>