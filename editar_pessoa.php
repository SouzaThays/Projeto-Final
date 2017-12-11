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
<?php include('menu.php'); ?>
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
                $("#dialogContatosEditar").dialog("open");
             
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
 

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="card-inside-title">Novo Participante</h2>
                        </div>
					
						<script src="view/js/Validacaoform.js">  </script>						
                        <div class="body">

                            <form class="" action="" id="form" name="form" method="post">
							

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
													<input type="text" class=" date form-control " id="dataNascimento" name="dataNascimento" value="<?php echo date("d/m/Y", strtotime( $row3['dataNascimento'])); ?>" placeholder="Ex: 30/07/2016" required>
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
												<option <?php if($vperiodo == "2º") {echo $vChecked;}?>>2º</option>
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

									</div>
									<div class="button-demo">
										<div>
											<input type="button" name="idAdicionarEditar" id="idAdicionarEditar" value="Adicionar Contato" class="btn bg-puc waves-effect" />
											<input type="submit" name="CadastrarEditar" id="CadastrarEditar" value="Cadastrar" class="btn bg-puc waves-effect" />
											<input type="hidden" name="okEditar" id="okEditar" value="" />
																					</div>
									</div>
                                   
									
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
				<td><input type="text" class="form-control " id="descricaoDesp" name="descricaoDesp" style="border:0;" required></td>
				<td><input type="text" class="form-control " id="telefoneContato" name="valorDesp" style="border:0;"  pattern="\([0-9]{3}\) [0-9]{4,6}-[0-9]{3,4}$" required></td>
				<td><input type="text" class="form-control " id="emailPar" name="emailPar" style="border:0;" required></td>
				<td><input type="text" class="form-control " id="grau" name="grau" style="border:0;" required></td>
				<td>
					<i class="material-icons" id="Excluir" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>

				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5" style="text-align: left;">
					<button onclick="AddTableRowDes()" type="submit" class="btn btn-danger waves-effect">Adicionar Contato</button>
					<button type="submit" id="GravarDes" class="btn btn-danger waves-effect">OK</button>
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
				<td><input type="text" class="form-control" id="descricaoDesp" name="descricaoDesp" style="border:0;" value="<?php echo $rowDes['nome']; ?>"></td>
				<td><input type="text" class="form-control " id="valorDesp" name="valorDesp" style="border:0;" value="<?php echo $rowDes['telefone']; ?>"></td>
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
					<button onclick="AddTableRow()" type="button" class="btn btn-danger waves-effect">Adicionar </button>
					<button type="submit" id="GravarDesEdit" class="btn btn-danger waves-effect">OK</button>
				</td>
				
			</tr>
		</tfoot>
	</table>


</div>

<script>


    (function () {      
    


        $(function () {
            $("#dataNascimento").datepicker({
                dateFormat: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0"
            }).bind("change", function () {
                var minValue = $(this).val();

                minValue = $.datepicker.parseDate("dd/mm/yy", minValue);
                minValue.setDate(minValue.getDate());
                $("#dataNascimento").datepicker("option", "minDate", minValue);
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

            var vDescricao = "";
            var vValor = "";
            var vEmail = "";
            var vGrau = "";

            $('#tbContato').find('tr').each(function (indice) {
                $(this).find('td').each(function (indice) {

                    vDescricao = $(this).find('#descricaoDesp').val();
                    vValor = $(this).find('#valorDesp').val();
                    vEmail = $(this).find('#emailPar').val();
                    vGrau = $(this).find('#grau').val();

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
            cols += '<td><input type="text" class="form-control " id="descricaoDesp" name="descricaoDesp" style="border:0;" required></td>';
            cols += '<td><input type="text" class="form-control tel" id="valorDesp" name="valorDesp" style="border:0;" required></td>';
            cols += '<td><input type="text" class="form-control " id="emailPar" name="emailPar" style="border:0;" required></td>'
            cols += '<td><input type="text" class="form-control " id="grau" name="grau" style="border:0;" required></td>'
            cols += '<td>';
            cols += '<i class="material-icons" id="Excluir" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>';
            cols += '</td>'; 
            newRow.append(cols); $("#tbContatoEditar").append(newRow);
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
  
