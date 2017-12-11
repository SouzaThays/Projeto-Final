<?php include('menu.php');

require_once('controller/ControleFaq.php');
Faq('incluir');

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
							<h2 class="card-inside-title"> FAQ</h2>
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
                                                    <div class="col-md-12">
                                                        <b>Pergunta</b>
                                                        <div>
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" id="pergunta" name="pergunta" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <b>Resposta</b>
                                                        <div>
                                                            <div class="form-line">
                                                                <textarea rows="0" class="form-control auto-growth" placeholder="..." id="resposta" name="resposta"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
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

                    vPergunta = $(this).find('#pergunta').val();
                    vResposta = $(this).find('#resposta').val();
           
                    if (typeof vPergunta != "undefined") {

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaPergunta[]',
                            value: vPergunta
                        }).appendTo('#form');

                        $('<input/>', {
                            type: 'hidden',
                            name: 'ListaResposta[]',
                            value: vResposta
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
            cols += '<td> <div class="col-md-12"> ';
            cols +=   ' <b>Pergunta </b > ';
            cols += '     <div>';
            cols += '          <div class="form-line">';
            cols += '              <input type="text" class="form-control" id="pergunta" name="pergunta" required />';
            cols += '            </div>';
            cols += '        </div>'
            cols += '     </div >';
            cols += '   <div class="col-sm-12">';
            cols += '        <b>Resposta</b>';
            cols += '        <div>';
            cols += '            <div class="form-line">';
            cols += '               <textarea rows="0" class="form-control auto-growth" placeholder="..." id="resposta" name="resposta"></textarea>';
            cols += '           </div>';
            cols += '      </div>';
            cols += '   </div></td>';         
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


