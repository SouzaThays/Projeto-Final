<?php 
$vidProjeto = $_GET['idProjeto'];

if(empty($vidProjeto)){
    require_once('controller/ControleProjeto.php'); 
    Projeto('incluir');  
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

                $("#dialogDespesasEditar").dialog({
                    width: "800px",
                    modal: true,
                    autoOpen: false,
                });

                $("#dialogDespesas").dialog({
                    width: "800px",
                    modal: true,
                    autoOpen: false,
                });

                $("#idAdicionar").click(function () {
                    $("#dialogDespesas").dialog("open");
                    calcular();
                });

                $("#idAdicionarEditar").click(function () {
                    $("#dialogDespesasEditar").dialog("open");
                    calcularEditar();
                });



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
                        <h2 class="card-inside-title">Novo Projeto</h2>
                    </div>


                    <div class="body">
                        <form class="form_advanced_validation" action="" id="form" name="form" method="post">
                            <?php  if(empty($vidProjeto)){ ?>
                            <div id="msg"></div>
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-5">
                                        <?php
                                       require_once('controller/ControlePlanejamento.php');
                                       Planejamento('consultarAtivos');
										?>

                                            <b>Planejamento</b>

                                        <select class="form-control show-tick" id="fkPlanejamento" name="fkPlanejamento"><?php while ($row1 = mysqli_fetch_array($rsPlanejamento)) { ?>
                                            <option value="<?php echo $row1['idPlanejamento']; ?>"><?php echo $row1['descricao']; ?></option><?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                       <?php
                                       require_once('controller/ControlePrograma.php');
                                       Programa('consultar');
									?>

                                            <b>Programa</b>

                                        <select class="form-control show-tick" id="fkprograma" name="fkprograma"><?php while ($row2 = mysqli_fetch_array($rsPrograma)) { ?>
                                            <option value="<?php echo $row2['idprograma']; ?>"><?php echo $row2['atuacao']; ?></option><?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-11">
                                        <b>Nome *</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" required>
                                            </div>
                                        </div>
                                    </div>
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
                                        <b>Número de vagas</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="number" class="form-control " id="numVagas" name="numVagas" placeholder="Número" min="0" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <b>Descrição</b>
                                        <div>
                                            <div class="form-line">
                                                <textarea rows="5" class="form-control auto-growth" placeholder="..." id="informacao" name="informacao"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="demo-checkbox">
                                            <input type="checkbox" id="certifPC" name="certifPC" value="Sim" class="filled-in chk-col-red" />
                                            <label for="certifPC">Validar como projeto comunitario</label>
                                            <input type="checkbox" id="certifHC" name="certifHC" class="filled-in chk-col-red" value="Sim" />
                                            <label for="certifHC">Validar como horas complementares</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <b>Assessoria</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control " id="assessoria" name="assessoria" placeholder="Assessoria" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Responsável</b>
                                        <div>

                                            <div class="form-line">
                                                <input type="text" class="form-control " id="responsavel" name="responsavel" placeholder="Nome Responsável" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <b>Local *</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control " id="local" name="local" placeholder="Local" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Taxa da inscrição</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control " id="valorTaxa" name="valorTaxa" placeholder="Taxa" min="0">

                                            </div>

                                        </div>
                                    </div>
                                </div>

								<div class="button-demo">
									<div>
										<input type="submit" name="idCadastrar" id="idCadastrar" value="Cadastrar" class="btn bg-puc waves-effect" />
										<input type="hidden" name="okCadastrar" id="okCadastrar" value="" />
										<input type="button" name="idAdicionar" id="idAdicionar" value="Adicionar Despesa" class="btn bg-puc waves-effect" />
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
                                           require_once('controller/ControlePlanejamento.php');
                                           Planejamento('consultar');
														  ?>
                                        <p>
                                            <b>Planejamento</b>
                                        </p>
                                        <select class="form-control show-tick" id="fkPlanejamento" name="fkPlanejamento"><?php
                                           $idPlan =  $row1['fkPlanejamento'];
                                           $vSelected = "selected";
                                           while ($row2 = mysqli_fetch_array($rsPlanejamento)) { ?>
                                            <option value="<?php echo $row2['idPlanejamento'];?>"
                                                    <?php if($idPlan == $row2['idPlanejamento']){
                                                              echo $vSelected;
                                                          }?>>
                                                    <?php echo $row2['descricao']; ?>
                                            </option><?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-5"><?php
                                           require_once('controller/ControlePrograma.php');
                                           Programa('consultar');
														  ?>
                                        <p>
                                            <b>Programa</b>
                                        </p>
                                        <select class="form-control show-tick" id="fkprograma" name="fkprograma"><?php
                                           $idProg =  $row1['fkprograma'];
                                           $vSelected = "selected";
                                           while ($row3 = mysqli_fetch_array($rsPrograma)) { ?>
                                            <option value="<?php echo $row3['idprograma'];?>"
                                                    <?php if($idProg == $row3['idprograma']){
                                                              echo $vSelected;
                                                          }?>>
                                            <?php echo $row3['atuacao']; ?>
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
                                    <div class="col-md-11">
                                        <b>Nome</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" value="<?php echo $row1['nome']; ?>">
                                            </div>
                                        </div>
                                    </div>
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
                                        <b>Número de vagas</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="number" class="form-control " id="numVagas" name="numVagas" placeholder="Número" min="0" value="<?php echo $row1['numVagas']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Tipo de vaga</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control " id="tipo" name="tipo" value="<?php echo $row1['tipoVaga']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <b>Descrição</b>
                                        <div>
                                            <div class="form-line">
                                                <textarea rows="5" class="form-control auto-growth" placeholder="..." id="informacao" name="informacao" title="Por favor preencha o campo Informação"><?php echo $row1['informacao']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="demo-checkbox"><?php
                                           $vCertifHC = $row1['certifHC'];
                                           $vCertifPC = $row1['certifPC'];
                                           $vChecked= "checked";
																   ?>
                                            <input type="checkbox" id="certifPC" name="certifPC" value="Sim" class="filled-in chk-col-red" <?php if($vCertifHC == "Sim"){ echo $vChecked;}?> />
                                            <label for="certifPC">Validar como projeto comunitario</label>
                                            <input type="checkbox" id="certifHC" name="certifHC" class="filled-in chk-col-red" value="Sim" <?php if($vCertifPC == "Sim"){ echo $vChecked;}?> />
                                            <label for="certifHC">Validar como horas complementares</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <b>Assessoria</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control " id="assessoria" name="assessoria" placeholder="Assessoria" value="<?php echo $row1['assessoria']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <b>Responsável</b>
                                        <div>

                                            <div class="form-line">
                                                <input type="text" class="form-control " id="responsavel" name="responsavel" placeholder="Nome Responsável" value="<?php echo $row1['responsavel']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <b>Local</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="text" class="form-control " id="local" name="local" placeholder="Local" value="<?php echo $row1['local']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Taxa da inscrição</b>
                                        <div>
                                            <div class="form-line">
                                                <input type="number" class="form-control " id="valorTaxa" name="valorTaxa" placeholder="Taxa" min="0" value="<?php echo $row1['valorTaxa']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-demo">
                                    <div>
                                        <input type="button" name="idAdicionarEditar" id="idAdicionarEditar" value="Adicionar Gastos" class="btn bg-puc waves-effect" />
                                        <input type="submit" name="CadastrarEditar" id="CadastrarEditar" value="Cadastrar" class="btn bg-puc waves-effect" />
                                        <input type="hidden" name="okEditar" id="okEditar" value="" />

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

<div id="dialogDespesas" title="Despesas">

    <table id="tbDespesa" class="table table-bordered table-striped table-hover">
        <tbody>
            <tr>
                <th>Descrição</th>
                <th width="100px">Valor</th>
                <th width="20px">Excluir</th>
            </tr>
            <tr>
                <td><input type="text" class="form-control " id="descricaoDesp" name="descricaoDesp" style="border:0;" required></td>
                <td><input type="text" class="form-control " id="valorDesp" name="valorDesp" style="border:0;" required></td>
                <td>
                    <i class="material-icons" id="Excluir" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>

                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="text-align: left;">
                    <button onclick="AddTableRowDes()" type="button" class="btn bg-puc waves-effect">Adicionar Despesa</button>
                    <button  type="button" id="GravarDes" class="btn btn-danger waves-effect">OK</button>
                </td>
                <td colspan="2" style="text-align: center;">
                    <input type="text"  id="valortotalDes" name="valortotalDes" style="border:0;" value="" >
                    <i class="material-icons" style="cursor:pointer;" onclick="calcular()">sync</i>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<div id="dialogDespesasEditar" title="Despesas">

    <table id="tbDespesaEditar" class="table table-bordered table-striped table-hover">
        <tbody>
            <tr>
                <th>Descrição</th>
                <th width="100px">Valor</th>
                <th width="20px">Excluir</th>
            </tr>
            <?php while ($rowDes = mysqli_fetch_array($rsDesp)) { ?>
            <tr>

                <td><input type="text" class="form-control" id="descricaoDesp" name="descricaoDesp" style="border:0;" value="<?php echo $rowDes['mnDespesas']; ?>"></td>
                <td><input type="text" class="form-control " id="valorDesp" name="valorDesp" style="border:0;" value="<?php echo $rowDes['valor']; ?>"></td>
                <td style = "display:none"><input type="hidden" id="idDesp" name="idDesp" value="<?php echo $rowDes['idDespesas']; ?>"></td>
                <td>
                    <i class="material-icons" id="ExcluirEd" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>


                </td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td style="text-align: left;">
                    <button onclick="AddTableRow()" type="button" class="btn btn-danger waves-effect">Adicionar Despesa</button>
                    <button type="button" id="GravarDesEdit" class="btn bg-puc waves-effect">OK</button>
                </td>
                <td colspan="2" style="text-align: center;">
                    <input type="text"  id="valortotal" name="valortotal" style="border:0;" value="" >
                    <i class="material-icons" style="cursor:pointer;" onclick="calcularEditar()">sync</i>
                </td>
            </tr>
        </tfoot>
    </table>


</div>

<script>


    (function () {


        function getMoney(n) {
            return "R$ " + n.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
        }

      

        $(function () {
            $("#dataInicio").datepicker({ dateFormat: 'dd/mm/yy' }).bind("change", function () {
                var minValue = $(this).val();
                minValue.setDate(minValue.getDate());
                $("#dataInicio").datepicker("option", "minDate", minValue);
            })
        });

        $(function () {
            $("#dataFim").datepicker({ dateFormat: 'dd/mm/yy' }).bind("change", function () {
                var minValue = $(this).val();
                minValue.setDate(minValue.getDate());
                $("#dataFim").datepicker("option", "minDate", minValue);
            })
        });

        calcularEditar = function () {

            valor = 0;

            $('#tbDespesaEditar').find('tr').each(function (indice) {
                $(this).find('td').each(function (indice) {

                    vValor = $(this).find('#valorDesp').val();

                    itValor = parseInt(vValor);

                    if (itValor > 0) {
                        itValor = parseInt(vValor);
                        valor = valor + itValor;
                    }

                });
            });

            //if (Number.isNaN(valor)) {
            if (typeof vValor == "undefined" && valor == 0) {
                valor = "0,00";
            } else {
                valor = getMoney(valor);
            }
            document.getElementById('valortotal').value = valor;
        };



        calcular = function () {

            valor = 0;
            $('#tbDespesa').find('tr').each(function (indice) {
                $(this).find('td').each(function (indice) {

                    vValor = $(this).find('#valorDesp').val();

                    itValor = parseInt(vValor);

                    if (itValor > 0) {
                        itValor = parseInt(vValor);
                        valor = valor + itValor;
                    }
 
                });
            });

            if (valor == 0) {
                valor = "0,00";
            } else {
                valor = getMoney(valor);
            }

            document.getElementById('valortotalDes').value = valor;

        };
// ------------------------   --------------------------------------------------//
        $("#GravarDes").click(function () {
            $("#dialogDespesas").dialog("close");
        });

        $("#GravarDesEdit").click(function () {
            $("#dialogDespesasEditar").dialog("close");
        });

// ------------------------ salvar --------------------------------------------------//
        $("#idCadastrar").click(function () {

            document.getElementById('okCadastrar').value = "ok";

            var vDescricao = "";
            var vValor = "";

            $('#tbDespesa').find('tr').each(function (indice) {
                $(this).find('td').each(function (indice) {

                    vDescricao = $(this).find('#descricaoDesp').val();
                    vValor = $(this).find('#valorDesp').val();


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

                });
            });
            //
        });

// ------------------------ editar --------------------------------------------------//

        $("#CadastrarEditar").click(function () {

            document.getElementById('okEditar').value = "ok";

            var vDescricao = "";
            var vValor = "";
            var vId = "";

            $('#tbDespesaEditar').find('tr').each(function (indice) {
                $(this).find('td').each(function (indice) {

                    vDescricao = $(this).find('#descricaoDesp').val();
                    vValor = $(this).find('#valorDesp').val();
                    vId = $(this).find('#idDesp').val();

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

           
            $(".valorDesp").mask('00000,00', { reverse: true });

            var newRow = $("<tr>"); var cols = "";
            cols += '<td><input type="text" class="form-control " id="descricaoDesp" name="descricaoDesp" style="border:0;"></td>';
            cols += '<td><input type="text" class="form-control valorDesp" id="valorDesp" name="valorDesp" style="border:0;"></td>';
            cols += '<td>';
            cols += '<i class="material-icons" id="Excluir" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>';
            cols += '</td>';
            newRow.append(cols); $("#tbDespesa").append(newRow);


            return false;

        };


        AddTableRow = function () {

            $(".valorDesp").mask('00000,00', { reverse: true });

            var newRow = $("<tr>"); var cols = "";
            cols += '<td><input type="text" class="form-control " id="descricaoDesp" name="descricaoDesp" style="border:0;"></td>';
            cols += '<td><input type="text" class="form-control valorDesp" id="valorDesp" name="valorDesp" style="border:0;"></td>';
            cols += '<td style = "display:none"><input type="hidden" id="idDesp" name="idDesp" ></td>';
            cols += '<td>';
            cols += '<i class="material-icons" id="ExcluirEd" style="cursor:pointer;" onclick="RemoveTableRow(this)">delete</i>';
            cols += '</td>';
            newRow.append(cols); $("#tbDespesaEditar").append(newRow);



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