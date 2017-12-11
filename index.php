
<!DOCTYPE html>
<html lang="pt-br">

<?php include('default.php'); ?>
<?php
require_once('controller/ControleDoacao.php');
Doacao('ranking');

require_once('controller/ControleDepoimento.php');
Depoimento('consultarAceito');

?>

<head></head>

<body class="theme-puc">
    <?php  include('menu_entrada.php'); ?>

    <section>

        <aside id="leftsidebar" class="sidebar">
            <?php include('informacao_participante.php'); ?>

        </aside>
    </section>

    <section class="content">


		<!-- Basic Example -->
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>OBSERVATÓRIO DE EVANGELIZAÇÃO E PASTORAL</h2>
					<ul class="header-dropdown m-r--5">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="material-icons">more_vert</i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li>
									<a href="javascript:void(0);">Action</a>
								</li>
								<li>
									<a href="javascript:void(0);">Another action</a>
								</li>
								<li>
									<a href="javascript:void(0);">Something else here</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="body">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							<li data-target="#carousel-example-generic" data-slide-to="2"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="item active">
                                <img src="view/images/user-img-background1.jpg" width="1000"  />
							</div>
							<div class="item">

								<img src="view/images/FOTO2.jpg" width="1000" height="10" />
							</div>
							<div class="item">
								<img src="view/images/user-img-background.jpg" width="1000"  />
								
							</div>
						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>DEPOIMENTOS</h2>
                
                </div>
                <div class="body">
                    <div class="row">

                        <?php while ($row = mysqli_fetch_array($rsDepoimento)) { ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="card">
                                <b>
                                    Participante:
                                </b>
                                <?php echo $row['nome']; ?>                             
                                <div class="body bg-pink">
                                    <?php echo $row['mensagem']; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                      
                </div>
            </div>
        </div>




        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="card-inside-title">Ranking - Trote Solidário</h2>
                        </div>
                        <script src="view/js/Validacaoform.js"></script>
                        <div class="body">
                            <div class="body">
                                <?php while ($row = mysqli_fetch_array($rs)) { ?><?php $escola = $row['nome'];
                                                                                       $qtd = $row['SUM(d.pontuacao)'];

                                                                                       if($escola == "Escola de Direito"){
                                                                                           $escolaDir = $escola;
                                                                                           $qtdDir = $qtd;
                                                                                       }
                                                                                       if($escola == "Escola de Arquitetura e Design"){
                                                                                           $escolaArq = $escola;
                                                                                           $qtdArq = $qtd;
                                                                                       }
                                                                                       if($escola == "Escola de comunicação e Artes"){
                                                                                           $escolaArtes = $escola;
                                                                                           $qtdArtes = $qtd;
                                                                                       }
                                                                                       if($escola == "Escola de Educação e Humanidade"){
                                                                                           $escolaEH = $escola;
                                                                                           $qtdEH = $qtd;
                                                                                       }
                                                                                       if($escola == "Escola de Medicina"){
                                                                                           $escolaMed = $escola;
                                                                                           $qtdMed = $qtd;
                                                                                       }
                                                                                       if($escola == "Escola de Negócio"){
                                                                                           $escolaNeg = $escola;
                                                                                           $qtdNeg = $qtd;
                                                                                       }
                                                                                       if($escola == "Escola Politécnica"){
                                                                                           $escolaPol = $escola;
                                                                                           $qtdPol = $qtd;
                                                                                       }
                                      }


                                      if($escolaDir == null){
                                          $escolaDir = "Direito";
                                          $qtdDir = 0;
                                      }
                                      if($escolaArq == null){
                                          $escolaArq =="Escola de Arquitetura e Design";
                                          $qtdArq = 0;
                                      }
                                      if($escolaArtes == null){
                                          $escolaArtes = "Escola de comunicacão e Artes";
                                          $qtdArtes = 0;
                                      }
                                      if($escolaEH == null){
                                          $escolaEH = "Escola de Educação e Humanidade";
                                          $qtdEH = 0;
                                      }
                                      if($escolaMed == null){
                                          $escolaMed = "Escola de Medicina";
                                          $qtdMed = 0;
                                      }
                                      if($escolaNeg == null){
                                          $escolaNeg = "Escola de Negócio";
                                          $qtdNeg = 0;
                                      }
                                      if($escolaPol == null){
                                          $escolaPol = "Escola Politécnica";
                                          $qtdPol = 0;
                                      }
																				 ?>
                                <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Pontuação", { role: "style" }],
                [" <?php echo $escolaDir; ?>", <?php echo $qtdDir; ?>, "#F44336"],
                ["<?php echo $escolaArq; ?>", <?php echo $qtdArq; ?>, "#2196F3"],
                ["<?php echo $escolaArtes; ?>", <?php echo $qtdArtes; ?>, "#9C27B0"],
                ["<?php echo $escolaEH; ?>", <?php echo $qtdEH; ?>, " #e5e4e2"],
                ["<?php echo $escolaMed; ?>", <?php echo $qtdMed; ?>, "#4CAF50"],
                ["<?php echo $escolaNeg; ?>", <?php echo $qtdNeg; ?>, "#B71C1C"],
                ["<?php echo $escolaPol; ?>", <?php echo $qtdPol; ?>, "#3F51B5"]
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var options = {
                title: "",
                width: 900,
                height: 300,
                bar: { groupWidth: "95%" },
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }
    </script>


</body>

</html>







