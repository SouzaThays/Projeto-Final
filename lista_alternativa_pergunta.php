<?php include('menu.php');

      

      require_once('controller/ControleEnquete.php');
      Enquete('consultarAlternativa');

      require_once('controller/ControleEnquete.php');
      Enquete('consultarPergunta');


      require_once('controller/ControleEnquete.php');
      Enquete('incluirEnquete');


      require_once('controller/ControleEnquete.php');
      Enquete('consultarEnquete');

      require_once('controller/ControleEnquete.php');
      Enquete('editarData');
      
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
        <?php include('menu.php'); ?>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2 class="card-inside-title"> Alternativa</h2>
						</div>
						<script src="view/js/Validacaoform.js"></script>
						<div class="body">
							<form id="form">
								<?php while ($row4 = mysqli_fetch_array($rsData)) { 
                                          $i =$row4['inicio'];
                                          if($row4['inicio'] == null || $i == "0000-00-00"){
                                              
								?>

								<div class="demo-masked-input">
									<div class="row clearfix">
										<div class="col-md-2">
										
											<div>
												<div class="form-line">
													<input type="hidden" class=" date form-control " id="dateInicio" name="dateInicio" >
												</div>
											</div>
										</div>

										<div class="col-md-2">
											
											<div>
												<div class="form-line">
													<input type="hidden" class=" date form-control " id="dateFim" name="dateFim" >
												</div>
											</div>
										</div>
									</div>
								</div>							
                                <?php 
                                          }


                                          else{?>




								<div class="demo-masked-input">
									<div class="row clearfix">
										<div class="col-md-2">
											
											<div>
												<div class="form-line">
													<input type="hidden" class=" date form-control " id="dateInicio" name="dateInicio" value="<?php echo date("d/m/Y", strtotime( $row4['inicio'])); ?>">
												</div>
											</div>
										</div>

										<div class="col-md-2">
											
											<div>
												<div class="form-line">
													<input type="hidden" class=" date form-control " id="dateFim" name="dateFim" value="<?php echo date("d/m/Y", strtotime( $row4['fim'])); ?>">
												</div>
											</div>
										</div>
									</div>
								</div>	
                                              
									

                                       <?php   }
                                      }
                                      $cont = $rsData->num_rows;
                                      if( $cont == 0){ ?>

                                          <div class="col-md-2">
                                         
                                            <div>
                                                <div class="form-line">
                                                    <input type="hidden" class=" date form-control " id="dateInicio" name="dateInicio" placeholder="Ex: 30/07/2016" value=""  />
                                                </div>
                                            </div>
                                        </div>

		                                <div class="col-md-2">
			                            
			                                <div>
				                                <div class="form-line">
                                                    <input type="hidden" class=" date form-control " id="dateFim" name="dateFim" placeholder="Ex: 30/07/2016" value="" />
				                                </div>
			                                </div>
		                                </div>
                                <?php  }




                                while ($row3 = mysqli_fetch_array($rs)) { ?>
										<div>
											<div class="form-line">
												<input type="hidden" class="form-control " name="idProjeto" id="idProjeto" value="<?php echo $row3['idProjeto']; ?>" />
											</div>
										</div>
                               <?php  }?>
										<div class="demo-masked-input">
											<div class="row clearfix">
												<div class="col-md-12">
													<b>Escolha uma pergunta</b>
													<select class="form-control show-tick" id="fkPergunta" name="fkPergunta">
                                                        <?php while ($row1 = mysqli_fetch_array($rsPergunta)) { ?>

														<option value="<?php echo $row1['idPerguntas']; ?>">
                                                            <?php echo $row1['descricao']; ?>
														</option>
                                                        <?php } ?>
													</select>
												</div>
											</div>
										</div>
							</form>
							<div class="col-md-12">
								<div id="conteudoAlternativa"></div>
							</div>
							<div class="demo-masked-input">
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="button-demo">
											<div>
												<input type="button" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn bg-puc waves-effect" onclick="cadastrar()" />
											</div>
										</div>
									</div>
								</div>								
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

        jQuery("#fkPergunta").change(function () {
            var idPergunta = jQuery(this).val();
            var idProjeto = $('#idProjeto').val();

            $.post('lista_alternativa_por_pergunta.php?pesquisar=ok&idPergunta=' + idPergunta + '&idProjeto=' + idProjeto + '', function (select) {
                $("#conteudoAlternativa").html(select);
            });
        });
    })(jQuery);


    $(function () {
        var dateFormat = "dd/mm/yy",
            from = $("#dateInicio")
                .datepicker({
                    dateFormat: 'dd/mm/yy',
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1
                })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));
                }),
            to = $("#dateFim").datepicker({
                dateFormat: 'dd/mm/yy',
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1
            })
                .on("change", function () {
                    from.datepicker("option", "maxDate", getDate(this));
                });
        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });

    cadastrar = function () {
        var $form = $('#form');
        $.post('lista_alternativa_pergunta.php?cria=ok', $form.serialize(), function (resposta) {
          
            alert("Cadastrado com sucesso !");
            
        });
        //var idProjeto = $('#idProjeto').val();
        //window.location.href = 'lista_alternativa_pergunta.php?pesquisar=ok&idProjeto=' + idProjeto;   
        window.location.href = 'lista_projeto_encerrado.php?pg=projetoEncerrado';

    }

</script>



selecione um pergunta




