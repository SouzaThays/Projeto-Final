<?php
$vidParticipante = $_GET['idUsuario'];
if(empty($vidParticipante)){
    require_once('controller/ControlePessoa.php');
    ProcessoPessoa('incluir');
}
else{
    require_once('controller/ControlePessoa.php'); 
    ProcessoPessoa('editar');  
    
    require_once('controller/ControlePessoa.php'); 
    ProcessoPessoa('consultarEstudante');      
    
    require_once('controller/ControlePessoa.php');
    ProcessoPessoa('consultarColaborador');
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>


	
        <?php include('default.php'); ?>
        <?php include('script.php'); ?>

	<script>
            $(document).ready(function () {
                var $seuCampoValor = $("#cpf");
                $seuCampoValor.mask('000.000.000-00', {
                    reverse: true,
                    placeholder: "___.___.___-__" 
                });
                var $seuCampoData = $("#datepicker");
                $seuCampoData.mask('00/00/0000', {
                    reverse: false,
                    placeholder: "__/__/____" 

                });
                var $rg = $("#rg");
                $rg.mask('00.000.000-0', {
                    reverse: false,
                    placeholder: "__.___.___-_" 
                });
                var $tel = $("#telefoneFixo");
                $tel.mask('(000)0000-0000', {
                    reverse: false,
                   
                });

                var $tel = $("#tel");
                $tel.mask('(000)0000-0000', {
                    reverse: false,

                });
                var $celular = $("#telefoneCelular");
                $celular.mask('(000)00000-0000', { 
                    reverse: false,
                   
                });


                var $contato = $("#telefoneContato");
                $contato.mask('(000)00000-0000', {
                    reverse: false,
                    
                });
                
               

            });
	</script>

	<script>

        $(function () {
            $.post('lista_curso.php', function (select) {
                $("#conteudoCurso").html(select);
            });



            $("#dialogContatosEditar").dialog({
                width: "800px",
                modal: true,
                autoOpen: false,
            });

            $("#dialogContato").dialog({
                width: "800px",
                modal: true,
                autoOpen: false,
            });

            $("#idAdicionar").click(function () {
                $("#dialogContato").dialog("open");
                
            });

            $("#idAdicionarEditar").click(function () {
                $("#dialogContatoEditar").dialog("open");
             
            });



        });

	</script>






</head>

<body class="theme-puc">
    <section>
        <aside id="leftsidebar" class="sidebar">
            <?php include('informacao_participante.php'); ?>
        </aside>
    </section>

    <section class="content">
        <?php include('menu_entrada.php'); ?>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="card-inside-title">Novo Participante</h2>
                        </div>
					
						<script src="view/js/Validacaoform.js">  </script>

						
						
                        <div class="body">

                            <script>


                                function tipoPessoaEstudante() {
                                    var estudante = document.getElementById("opt-estudante").checked;
                                    if (estudante) {
                                        document.getElementById("estudante").style.display = "block";
                                        document.getElementById("inf").style.display = "block";
                                        document.getElementById("colaborador").style.display = "none";
                                        document.getElementById("entidadeExterna").style.display = "none";


                                    }
                                }

                                function tipoPessoaColaorador() {
                                    var estudante = document.getElementById("opt-estudante").checked;
                                    if (colaborador) {
                                        document.getElementById("estudante").style.display = "none";
                                        document.getElementById("colaborador").style.display = "block";
                                        document.getElementById("entidadeExterna").style.display = "none";
                                        document.getElementById("inf").style.display = "none";
                                    }

                                }

                                function tipoPessoaEntidadeExterna() {
                                    var estudante = document.getElementById("opt-estudante").checked;
                                    if (entidadeExterna) {
                                        document.getElementById("estudante").style.display = "none";
                                        document.getElementById("colaborador").style.display = "none";
                                        document.getElementById("entidadeExterna").style.display = "block";
                                        document.getElementById("inf").style.display = "none";
                                    }

                                }
                            </script>



                            <form class="" action="" id="form" name="form" method="post">
								<?php  if(empty($vidParticipante)){ ?>
                                <div class="demo-masked-input">
                                    <div class="row clearfix">

                                        <div class="col-md-10">
                                            <b>Tipo de participante</b>
                                            <div class="demo-radio-button">
                                                <input name="TipoPessoa" type="radio" id="opt-estudante" value="masculino" class="radio-col-red" onclick="tipoPessoaEstudante();" checked />
                                                <label for="opt-estudante">Estudante</label>
                                                <input name="TipoPessoa" type="radio" id="opt-colaborador" value="feminino" class="radio-col-red" onclick="tipoPessoaColaorador();" />
                                                <label for="opt-colaborador">Colaborador</label>
                                                <input name="TipoPessoa" type="radio" id="opt-entidadeExterna" value="feminino" class="radio-col-red" onclick="tipoPessoaEntidadeExterna();" />
                                                <label for="opt-entidadeExterna">Entidade Externa</label>
                                            </div>
                                        </div>
                                        <div id="estudante" style="display: block;">
                                            <div class="col-md-10" id="estudante">
                                                <b>Matricula</b>
                                                <div>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Nome completo" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="colaborador" style="display: none;">
                                            <div class="col-md-6">
                                                <b>Matricula</b>
                                                <div>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="matriculaC" name="matriculaC" placeholder="Nome completo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <b>Cargo</b>
                                                <div>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Nome completo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="entidadeExterna" style="display: none;">
                                            <div class="col-md-12">
                                                <b>Instituição</b>
                                                <div>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Nome completo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <b>Nome *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Data nascimento *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class=" date form-control " id="datepicker1" name="dataNascimento"  placeholder="Ex: 30/07/2016"  title="Ex: 30/07/2016"  required  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <b>CPF *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control cpf " id="cpf" name="cpf" placeholder="Ex: 000-000-000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite CPF no formato: xxx-xxx-xxx-xx" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b>RG *</b>
                                            <div>

                                                <div class="form-line">
                                                    <input type="text" class="form-control rg " id="rg" name="rg" placeholder="Ex: 00.000.000-0" value="" pattern="\d{2}\.\d{3}\.\d{3}-\d{1}" title="Digite RG no formato:  xx.xxx.xxx-x"  required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <b>Orgão expedidor *</b>
                                            <select class="form-control show-tick" id="orgaoExpedidor" name="orgaoExpedidor"  required>
                                                <option>SSP</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Telefone Fixo</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="tel" class="form-control telFixo" placeholder="(041)3000-0000" id="telefoneFixo" name="telefoneFixo"  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Celular *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="tel" class="form-control celular" placeholder="(041)99000-00-00" id="telefoneCelular"  name="telefoneCelular" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <b>Email *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="email" class="form-control " placeholder="email" id="email" name="email" value="" title="xxx@dominio.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Sexo *</b>

                                            <div class="demo-radio-button">
                                                <input name="sexo" type="radio" id="Masculino" value="masculino" class="radio-col-red" checked />
                                                <label for="Masculino">Masculino</label>
                                                <input name="sexo" type="radio" id="feminino" value="feminino" class="radio-col-red" checked />
                                                <label for="feminino">Feminino</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Plano de Saúde</b>
                                            <div class="demo-radio-button">
                                                <input name="planoSaude" type="radio" id="simPlano" value="Sim" class="radio-col-red" checked />
                                                <label for="simPlano">Sim</label>
                                                <input name="planoSaude" type="radio" id="naoPlano" value="Não" class="radio-col-red" checked />
                                                <label for="naoPlano">Não</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Alergia</b>
                                            <div class="demo-radio-button">
                                                <input name="alergia" type="radio" id="simAlergia" value="Sim" class="radio-col-red" checked />
                                                <label for="simAlergia">Sim</label>
                                                <input name="alergia" type="radio" id="naoAlergia" value="Não" class="radio-col-red" checked />
                                                <label for="naoAlergia">Não</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Tipo sanguineo</b>
                                            <select class="form-control show-tick" id="tipoSanguineo" name="tipoSanguineo">
                                                <option>A+</option>
                                                <option>A-</option>
                                                <option>B+</option>
                                                <option>B-</option>
                                                <option>AB+</option>
                                                <option>AB-</option>
                                                <option>O+</option>
                                                <option>O-</option>
												<option>Não sei</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <b>Endereço *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control " placeholder="Rua, numero, complemento, cidade, estado" id="endereco" name="endereco" value="" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="inf" style="display: block;"><?php
                                           require_once('controller/ControleEscola.php');
                                           Escola('consultar');
                                                                              ?>

                                            <div class="col-md-4">
                                                <b>Escola</b>

                                                <select class="form-control show-tick" id="fkEscola" name="fkEscola"><?php while ($row1 = mysqli_fetch_array($rsEscola)) { ?>
                                                    <option value="<?php echo $row1['idEscola']; ?>"><?php echo $row1['nome']; ?> </option><?php } ?>
                                                </select>

                                            </div>
                                            
											<div class="col-md-4">
												<div id="conteudoCurso"></div>
											</div>
                                            <div class="col-md-2">
                                                <b>Periodo</b>
                                                <select class="form-control show-tick" id="periodo" name="periodo">
                                                    <option>1º</option>
                                                    <option>2º</option>
                                                    <option>3º</option>
                                                    <option>4º</option>
                                                    <option>5º</option>
                                                    <option>6º</option>
                                                    <option>7º</option>
                                                    <option>8º</option>
                                                    <option>9º</option>
                                                    <option>10º</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <b>Turno</b>
                                                <select class="form-control show-tick" id="turno" name="turno">
                                                    <option>Manhã</option>
                                                    <option>Tarde</option>
                                                    <option>Noite</option>
                                                    <option>Integral</option>
                                                </select>
                                            </div>
											
                                        </div>
										

                                    </div>
                                    <div class="button-demo">
                                        <div>
											<input type="submit" name="idCadastrar" id="idCadastrar" value="Cadastrar" class="btn bg-puc waves-effect" />
											<input type="hidden" name="okCadastrar" id="okCadastrar" value="" />
											<input type="button" name="idAdicionar" id="idAdicionar" value="Adicionar Contato" class="btn bg-puc waves-effect" />
                                        </div>
                                    </div>
                                </div>
								 
								

							

 <!---------------------------------------------------------------------------ATUALIZAR-------------------------------------------------------------------------------->
								<?php } else { ?>

								    <?php while ($row3 = mysqli_fetch_array($rs)) { ?>
                                
								<div class="demo-masked-input">
									<div class="row clearfix">
										<div class="col-md-10">
											<b>Nome</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" value="<?php echo $row3['nome']; ?>" required>
												</div>
											</div>
										</div>
										<div class="col-md-2">
											<b>Data nascimento</b>
											<div>
												<div class="form-line">
													<input type="text" class=" date form-control " id="dataNascimento" name="dataNascimento" value="<?php echo $row3['dataNascimento']; ?>" placeholder="Ex: 30/07/2016" required>
												</div>
											</div>
										</div>
										<div class="col-md-2">
											<b>CPF</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control cpf " id="cpf" name="cpf" placeholder="Ex: 00-000-000-0" value="<?php echo $row3['cpf']; ?>" disabled>
												</div>
											</div>
										</div>
										<div class="col-md-2">
											<b>RG</b>
											<div>

												<div class="form-line">
													<input type="text" class="form-control rg " id="rg" name="rg" placeholder="Ex: 000.000.000-04" value="<?php echo $row3['rg']; ?>" required>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<b>Orgão expedidor</b>
											<select class="form-control show-tick" id="orgaoExpedidor" name="orgaoExpedidor" value="<?php echo $row3['orgaoExpedidor']; ?>" required>
												<option>SSP</option>
											</select>
										</div>
										<div class="col-md-2">
											<b>Telefone Fixo</b>
											<div>
												<div class="form-line">
													<input type="tel" class="form-control telFixo" placeholder="(041)3000-0000" id="telefoneFixo" name="telefoneFixo" value="<?php echo $row3['telefoneFixo']; ?>">
												</div>
											</div>
										</div>
										<div class="col-md-2">
											<b>Celular</b>
											<div>
												<div class="form-line">
													<input type="tel" class="form-control celular" placeholder="(041)99000-00-00" id="telefoneCelular" value=" <?php echo $row3['telefoneCelular']; ?> " name="telefoneCelular" required>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<b>Email</b>
											<div>
												<div class="form-line">
													<input type="email" class="form-control " placeholder="email" id="email" name="email" value="<?php echo $row3['email']; ?>" required>
												</div>
											</div>
										</div>

										<div class="col-md-2">
											<b>Sexo</b>
											<div class="demo-radio-button"><?php
                                              $vSexo = $row3['sexo'];
                                              $vChecked= "checked";
                                                                           ?>
												<input name="sexo" type="radio" id="masculino" value="masculino" class="radio-col-red" <?php if($vSexo == "masculino"){ echo $vChecked;}?> />
												<label for="masculino">Masculino</label>
												<input name="sexo" type="radio" id="feminino" value="feminino" class="radio-col-red" <?php if($vSexo != "masculino"){ echo $vChecked;}?> />
												<label for="feminino">Feminino</label>
											</div>
										</div>

										<div class="col-md-2">
											<b>Plano de Saúde</b>
											<div class="demo-radio-button"><?php
                                              $vPlanoSaude = $row3['planoSaude'];
                                              $vChecked= "checked";
                                                                           ?>
												<input name="planoSaude" type="radio" id="simPlano" value="sim" class="radio-col-red" <?php if($vPlanoSaude == "sim"){ echo $vChecked;}?> />
												<label for="simPlano">Sim</label>
												<input name="planoSaude" type="radio" id="naoPlano" value="não" class="radio-col-red" <?php if($vPlanoSaude == "não"){ echo $vChecked;}?> />
												<label for="naoPlano">Não</label>
											</div>
										</div>
										<div class="col-md-2">
											<b>Alergia</b>
											<div class="demo-radio-button"><?php
                                              $vAlegia = $row3['alergia'];
                                              $vChecked= "checked";
                                                                           ?>
												<input name="alergia" type="radio" id="simAlergia" value="sim" class="radio-col-red" <?php if($vAlegia == "sim"){ echo $vChecked;}?> />
												<label for="simAlergia">Sim</label>
												<input name="alergia" type="radio" id="naoAlergia" value="não" class="radio-col-red" <?php if($vAlegia == "não"){ echo $vChecked;}?> />
												<label for="naoAlergia">Não</label>
											</div>
										</div>


										<div class="col-md-2">
											<b>Tipo sanguineo</b>

											<select class="form-control show-tick" id="tipoSanguineo" name="tipoSanguineo"><?php $vTipo = $row3['tipoSanguineo'];
                                                                                                                                 $vChecked= "selected";?>
												<option <?php if($vTipo == "A+"){ echo $vChecked;}?>>A+</option>
												<option <?php if($vTipo == "A-"){ echo $vChecked;}?>>A-</option>
												<option <?php if($vTipo == "B+"){ echo $vChecked;}?>>B+</option>
												<option <?php if($vTipo == "B-"){ echo $vChecked;}?>>B-</option>
												<option <?php if($vTipo == "AB+"){ echo $vChecked;}?>>AB+</option>
												<option <?php if($vTipo == "AB-"){ echo $vChecked;}?>>AB-</option>
												<option <?php if($vTipo == "O+"){ echo $vChecked;}?>>O+</option>
												<option <?php if($vTipo == "O-"){ echo $vChecked;}?>>O-</option>
												<option <?php if($vTipo == "Não sei"){ echo $vChecked;}?>>Não sei</option>

											</select>
										</div><?php } ?>
                                        
                                        <?php while ($row10 = mysqli_fetch_array($rsPessoaC)) {
                                        ?>
										<?php $v = $row4['periodo'];?>


										<div class="col-md-4">
											<b>Periodo</b>

											<select class="form-control show-tick" id="periodo" name="periodo"><?php $vperiodo = $row10['periodo'];
                                                                                                                     $vChecked= "selected";   ?>

												<option <?php if($vperiodo == "1º"){ echo $vChecked;}?>>1º</option>
												<option <?php if($vperiodo == "2º"){ echo $vChecked;}?>>2º</option>
												<option <?php if($vperiodo == "3º"){ echo $vChecked;}?>>3º</option>
												<option <?php if($vperiodo == "4º"){ echo $vChecked;}?>>4º</option>
												<option <?php if($vperiodo == "5º"){ echo $vChecked;}?>>5º</option>
												<option <?php if($vperiodo == "6º"){ echo $vChecked;}?>>6º</option>
												<option <?php if($vperiodo == "7º"){ echo $vChecked;}?>>7º</option>
												<option <?php if($vperiodo == "8º"){ echo $vChecked;}?>>8º</option>
												<option <?php if($vperiodo == "9º"){ echo $vChecked;}?>>9º</option>
												<option <?php if($vperiodo == "10º"){ echo $vChecked;}?>>10º</option>
											</select>

										</div>

										<div class="col-md-4">
											<b>Turno</b>

											<select class="form-control show-tick" id="turno" name="turno"><?php $vturno = $row10['turno'];
                                                                                                                 $vChecked= "selected";?>
												<option <?php if($vturno == "Manhã"){ echo $vChecked;}?>>Manhã</option>
												<option <?php if($vturno == "Tarde"){ echo $vChecked;}?>>Tarde</option>
												<option <?php if($vturno == "Noite"){ echo $vChecked;}?>>Noite</option>
												<option <?php if($vturno == "Integral"){ echo $vChecked;}?>>Integral</option>
											</select>
										</div>


										<div class="col-md-6">
											<b>Matricula</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control" id="matriculaC" name="matriculaC" placeholder="Nome completo" value="<?php echo $row10['matricula']; ?>">
												</div>
											</div>
										</div>
										<?php } ?>

										<!--------------------------------------COLABORADOR-------------------------------------------------------->

										<?php while ($row11 = mysqli_fetch_array($rsPessoaColab)) { ?>

										<div class="col-md-6">
											<b>Matricula</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control" id="matriculaC" name="matriculaC" placeholder="Nome completo" value="<?php echo $row11['matriculaColaborador']; ?>">
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<b>Cargo</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control" id="matriculaC" name="matriculaC" placeholder="Nome completo" value="<?php echo $row11['cargo']; ?>">
												</div>
											</div>
										</div>

										<?php } ?>

										<!--------------------------------------COLABORADOR-------------------------------------------------------->
										<?php require_once('controller/ControlePessoa.php');
                                              ProcessoPessoa('consultarEntidadeExterna');  ?>

										<?php while ($row12 = mysqli_fetch_array($rsEntidadeExterna)) { ?>
										<div class="col-md-6">
											<b>Instituição</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Nome completo" value="<?php echo $row12['instituicao']; ?>">
												</div>
											</div>
										</div>
                                        <?php } ?>

										<label for="from">From</label>
										<input type="text" id="from" name="from">
										<label for="to">to</label>
										<input type="text" id="to" name="to">

									</div>
									<div class="button-demo">
										<div>
											<input type="button" name="idAdicionarEditar" id="idAdicionarEditar" value="Adicionar Contato" class="btn bg-puc waves-effect" />
											<input type="submit" name="CadastrarEditar" id="CadastrarEditar" value="Cadastrar" class="btn bg-puc waves-effect" />
											<input type="hidden" name="okEditar" id="okEditar" value="" />
																					</div>
									</div>
                                   
									
								</div>
								  <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    </body>
</html>




<div id="dialogContato" title="Contato Familiar">


	<table id="tbContato" class="table table-bordered table-striped table-hover">
		<tbody>
			<tr>
				<th>Nome</th>
				<th width="200px">Número de telefone</th>
				<th >E-mail</th>
				<th >Grau Parentesco</th>
				<th >Excluir</th>
			</tr>
			<tr>
				<td><input type="text" class="form-control " id="nome" name="nome" style="border:0;" required></td>
				<td><input type="text" class="form-control " id="tel" name="tel" style="border:0;"  pattern="\([0-9]{3}\) [0-9]{4,6}-[0-9]{3,4}$" required></td>
				<td><input type="email" class="form-control " id="emailPar" name="emailPar" style="border:0;" required></td>
				<td><input type="text" class="form-control " id="grau" name="grau" style="border:0;" required></td>
				<td>
					<i class="material-icons" id="Excluir" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>

				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5" style="text-align: left;">
					<button onclick="AddTableRowDes()" type="submit" class="btn bg-puc waves-effect">Adicionar Contato</button>
					<button type="submit" id="GravarDes" class="btn bg-puc waves-effect">OK</button>
				</td>
				
			</tr>
		</tfoot>
	</table>
</div>

<div id="dialogContatosEditar" title="Contato">
	

	<table id="tbContatoEditar" class="table table-bordered table-striped table-hover">


		<tbody>
			<tr>
				<th>Nome</th>
				<th width="200px">Número de telefone</th>
				<th>E-mail</th>
				<th>Grau Parentesco</th>
				<th>Excluir</th>
			</tr>
            <?php while ($rowDes = mysqli_fetch_array($rsContato)) { ?>
			<tr>
				<td><input type="text" class="form-control" id="nome" name="nome" style="border:0;" value="<?php echo $rowDes['nome']; ?>"></td>
				<td><input type="text" class="form-control " id="tel" name="tel" style="border:0;" value="<?php echo $rowDes['telefone']; ?>"></td>
				<td><input type="text" class="form-control " id="emailPar" name="emailPar" style="border:0;"  value="<?php echo $rowDes['email']; ?>"></td>
				<td><input type="text" class="form-control " id="grau" name="grau" style="border:0;"  value="<?php echo $rowDes['grau']; ?>"></td>
				<td style="display:none"><input type="hidden" id="idContatoFamiliar" name="idContatoFamiliar" value="<?php echo $rowDes['idContatoFamiliar']; ?>"></td>
				<td>
					<i class="material-icons" id="ExcluirEd" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>
				</td>
			</tr>
            <?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5" style="text-align: left;">
					<button onclick="AddTableRow()" type="button" class="btn bg-puc waves-effect">Adicionar </button>
					<button type="submit" id="GravarDesEdit" class="btn bg-puc waves-effect">OK</button>
				</td>
				
			</tr>
		</tfoot>
	</table>


</div>

<script>


    (function () {      
    


        $(function () {
            $("#datepicker1").datepicker({
                dateFormat: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0"
            }).bind("change", function () {
                var minValue = $(this).val();
                
                minValue = $.datepicker.parseDate("dd/mm/yy", minValue);
                minValue.setDate(minValue.getDate());
                $("#datepicker1").datepicker("option", "minDate", minValue);
            })
        });


        jQuery("#fkEscola").change(function () {
            var idEscola = jQuery(this).val();

            $.post('lista_curso.php?pesquisar=ok&idEscola=' + idEscola + '', function (select) {
                $("#conteudoCurso").html(select);
            });
        });
        // ------------------------   --------------------------------------------------//
        $("#GravarDes").click(function () {
            $("#dialogContato").dialog("close");
        });

        $("#GravarDesEdit").click(function () {
            $("#dialogContatosEditar").dialog("close");
        });

        // ------------------------ salvar --------------------------------------------------//
        $("#idCadastrar").click(function () {

            document.getElementById('okCadastrar').value = "ok";

            var vNome = "";
            var vTel = "";
            var vEmail = "";
            var vGrau = "";

            $('#tbContato').find('tr').each(function (indice) {
                $(this).find('td').each(function (indice) {

                    vNome = $(this).find('#nome').val();
                    vTel = $(this).find('#tel').val();
                    vEmail = $(this).find('#emailPar').val();
                    vGrau = $(this).find('#grau').val();

                    if (typeof vNome != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaNomes[]',
                            value: vNome
                        }).appendTo('#form');

                    }
                    if (typeof vTel != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaTel[]',
                            value: vTel
                        }).appendTo('#form');

                    }
                    if (typeof vEmail != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaEmail[]',
                            value: vEmail
                        }).appendTo('#form');

                    }
                    if (typeof vGrau != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaGrau[]',
                            value: vGrau
                        }).appendTo('#form');

                    }

                });
            });
            //
        });


     

        // ------------------------ editar --------------------------------------------------//

        $("#CadastrarEditar").click(function () {

            document.getElementById('okEditar').value = "ok";

            var vDescricao = "";
            var vValor = "";
            var vEmail = "";
            var vGrau = "";
            var vId = "";

            $('#tbContatoEditar').find('tr').each(function (indice) {
                $(this).find('td').each(function (indice) {

                    vDescricao = $(this).find('#descricaoDesp').val();
                    vValor = $(this).find('#valorDesp').val();
                    vEmail = $(this).find('#emailPar').val();
                    vGrau = $(this).find('#grau').val();
                    vId = $(this).find('#idContatoFamiliar').val();

                    if (typeof vDescricao != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaDespesas[]',
                            value: vDescricao
                        }).appendTo('#form');

                    }
                    if (typeof vValor != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaValores[]',
                            value: vValor
                        }).appendTo('#form');

                    }
                    if (typeof vEmail != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaEmail[]',
                            value: vEmail
                        }).appendTo('#form');

                    }
                    if (typeof vGrau != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaGrau[]',
                            value: vGrau
                        }).appendTo('#form');

                    
                    }
                    if (typeof vId != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaId[]',
                            value: vId
                        }).appendTo('#form');

                    }

                });
            });


            //
        });


        
        AddTableRowDes = function () {
            $(".tel").mask("(999)9999-9999"); //Inicia
            var newRow = $("<tr>"); var cols = "";
            cols += '<td><input type="text" class="form-control " id="nome" name="nome" style="border:0;" required></td>';
            cols += '<td><input type="text" class="form-control tel" id="tel" name="tel" style="border:0;" required></td>';
            cols += '<td><input type="email" class="form-control " id="emailPar" name="emailPar" style="border:0;" required></td>'
            cols += '<td><input type="text" class="form-control " id="grau" name="grau" style="border:0;" required></td>'
            cols += '<td>';
            cols += '<i class="material-icons" id="Excluir" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>';
            cols += '</td>'; 
            newRow.append(cols); $("#tbContato").append(newRow);
            return false;

        };

   

        RemoveTableRow = function (handler) {

            var tr = $(handler).closest('tr');
            vId = tr.find('#idDesp').val();

            tr.fadeOut(400, function () {

                if (typeof vId != "undefined") {
                    $('<input/>', {
                        type: 'hidden',
                        name: 'ListaIdExcluidos[]',
                        value: vId
                    }).appendTo('#form');
                }
                tr.remove();
            });

            return false;
        };





    })(jQuery);


  

</script>
