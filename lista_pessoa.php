<?php include('menu.php'); ?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>
    <script>

        $(function () {

            $("#dialogDadosPessoais").dialog({
                width: "800px",
                modal: true,
                autoOpen: false,
            });



            $.post('lista_pessoa_tabela.php?', function (tabela) {
                $("#tbConteudo").html(tabela);
            });



        });

    </script>
</head>

<body class="theme-puc">
	<section>
		<aside id="leftsidebar" class="sidebar"><?php include('informacao.php'); ?>
		</aside>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								Lista de Pessoas
							</h2>
						</div>
						<div class="body">
<!--------------------------------------------------------------------------------------------------------------------------->
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>

                                            <p>
                                                <b>Projeto</b>
                                            </p>
                                              <input type="text" class="form-control " id="nomePesq" name="nomePesq" >
                                        </th>

                                        <th><?php
                                            require_once('controller/ControlePlanejamento.php');
                                            Planejamento('consultar');
                                            ?>
                                            <p>
                                                <b>Planejamento</b>
                                            </p>
                                            <select class="form-control show-tick" id="fkPrPesq" name="fkPrPesq">
                                                <option value="-1">Selecionar</option>
                                                <?php while ($row1 = mysqli_fetch_array($rsPlanejamento)) { ?>
                                                    <option value="<?php echo $row1['idPlanejamento']; ?>"><?php echo $row1['descricao']; ?></option
                                                ><?php } ?>
                                            </select>

                                        </th>

                                        <th><?php
                                            require_once('controller/ControlePrograma.php');
                                            Programa('consultar');
                                            ?>
                                            <p>
                                                <b>Programa</b>
                                            </p>
                                            <select class="form-control show-tick" id="fkPrograPesq" name="fkPrograPesq">
                                                <option value="-1">Selecionar</option>
                                                <?php while ($row2 = mysqli_fetch_array($rsPrograma)) { ?>
                                                    <option value="<?php echo $row2['idprograma']; ?>"><?php echo $row2['atuacao']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </th>
                                        <th>

                                            <i class="material-icons" style="cursor:pointer;" onclick="pesquisarFiltro()">search</i>

                                        </th>
                                    </tr>
                                </thead>
                                </table>
                                <!--------------------------------------------------------------------------------------------------------------------------->



							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover dataTable">
									<thead>
										<tr>
											<th>Nome</th>
											<th>CPF</th>
											
                                            <th></th>
										</tr>
									</thead>
									<tbody id="tbConteudo">

									</tbody>
								</table>

                                <form id="formPesquisar"></form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Exportable Table -->
		</div>
	</section>
    </body>
</html>

<div id="dialogDadosPessoais" title="Dados Pessoais">

    <div id="conteudo"></div>

</div>

<script>

    (function () {

        pesquisarFiltro = function () {

            nome = document.getElementById("nomePesq").value;
            projeto = document.getElementById("fkPrPesq").value;
            programa = document.getElementById("fkPrograPesq").value;



            $('<input/>', {
                type: 'hidden',
                name: 'nomeProjetoPesq',
                value: nome
            }).appendTo('#formPesquisar');

            $('<input/>', {
                type: 'hidden',
                name: 'fkProjetoPesq',
                value: projeto
            }).appendTo('#formPesquisar');

            $('<input/>', {
                type: 'hidden',
                name: 'fkProgramaPesq',
                value: programa
            }).appendTo('#formPesquisar');

            var $form = $('#formPesquisar');

            $.post('lista_pessoa_tabela.php?filtro=ok', $form.serialize(), function (tabela) {

                $("#tbConteudo").html(tabela);
            });


        }


        /***********************************************************************************************************/

        abreDados = function (id) {

            $.post('dados_pessoais.php?idPessoa=' + id + '', function (tabela) {
                $("#conteudo").html(tabela);
                $("#dialogDadosPessoais").dialog("open");
            });
        }

        fechar = function () {
            $("#dialogDadosPessoais").dialog("close");
        }

    })(jQuery);

</script>