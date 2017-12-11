<?php include('menu.php');

require_once('controller/ControleFaq.php');
Faq('editar');

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
										<?php while ($row3 = mysqli_fetch_array($rs)) { ?>
										<tbody>
											<tr>
												<th>Alternativa</th>
												
											</tr>
											<tr>
												<td>
                                                    <div class="col-md-12">
                                                        <b>Pergunta</b>
                                                        <div>
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" id="pergunta" name="pergunta" value="<?php echo $row3['pergunta']; ?>" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <b>Resposta</b>
                                                        <div>
                                                            <div class="form-line">
                                                                <textarea rows="0" class="form-control auto-growth" placeholder="..." id="resposta" name="resposta" ><?php echo $row3['resposta']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
												</td>

											</tr>

										</tbody>
										<?php } ?>
										<tfoot>
											<tr>
												<td colspan="5" style="text-align: left;">
                                                    <input type="submit" name="idCadastrar" id="idCadastrar" value="Cadastrar" class="btn bg-puc waves-effect" />
													<input type="hidden" name="ok" id="ok" value="" />
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



