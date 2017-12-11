<?php include('menu.php');

require_once('controller/ControleEnquete.php');
Enquete('incluirResposta');

require_once('controller/ControleEnquete.php');
Enquete('consultarTodasAlternativa');
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
							<h2 class="card-inside-title"> Alternativa</h2>
						</div>
						<script src="view/js/Validacaoform.js"></script>
						<div class="body">
							<form class="form_advanced_validation" action="" id="form" name="form" method="post">
								<div id="dialogDespesas" title="Alternativa">
									<table id="tbDespesa" class="table table-bordered table-striped table-hover">
										<tbody>
											<tr>
												<th>Alternativa</th>
												<th width="10">Excluir</th>
											</tr>

											<tr>
												<td>
													<input type="text" class="form-control " id="alternativa" name="alternativa" style="border:0;" required />
												</td>

												<td>
													<i class="material-icons" id="Excluir" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>

												</td>
											</tr>

										</tbody>
										<tfoot>
											<tr>
												<td colspan="5" style="text-align: left;">
                                                    <button onclick="AddTableRow()" type="button" class="btn bg-puc waves-effect">Adicionar </button>
                                                    <input type="submit" name="idCadastrar" id="idCadastrar" value="Cadastrar" class="btn bg-puc waves-effect" />
													<input type="hidden" name="okCadastrar" id="okCadastrar" value="" />
												</td>
											</tr>
										</tfoot>
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


<script>
    (function () {

        $('#optgroup').multiSelect({ selectableOptgroup: true });
    
          
  

        // ------------------------ salvar --------------------------------------------------//
        $("#idCadastrar").click(function () {

            document.getElementById('okCadastrar').value = "ok";

            var vPergunta = "";
            
            $('#tbDespesa').find('tr').each(function (indice) {
                $(this).find('td').each(function (indice) {

                    vPergunta = $(this).find('#alternativa').val();
           
                    if (typeof vPergunta != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaAlternativa[]',
                            value: vPergunta
                        }).appendTo('#form');

                    }
                });
            });
        });

        // ------------------------ editar --------------------------------------------------//

        $("#CadastrarEditar").click(function () {

            document.getElementById('okEditar').value = "ok";

            var vDescricao = "";
            var vId = "";

            $('#tbDespesaEditar').find('tr').each(function (indice) {
                $(this).find('td').each(function (indice) {

                    vDescricao = $(this).find('#pergunta').val();

                    if (typeof vDescricao != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaPergunta[]',
                            value: vDescricao
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
        });





        AddTableRow = function () {
            var newRow = $("<tr>"); var cols = "";
            cols += '<td><input type="text" class="form-control " id="alternativa" name="alternativa" style="border:0;"></td>';         
            cols += '<td style = "display:none"><input type="hidden" id="idDesp" name="idDesp" ></td>';
            cols += '<td>';
            cols += '<i class="material-icons" id="ExcluirEd" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>';
            cols += '</td>';
            newRow.append(cols); $("#tbDespesa").append(newRow);



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


