
<?php
require_once('controller/ControleDoacao.php');
Doacao('ranking');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head><?php include('default.php'); ?><?php include('script.php'); ?>
</head>

<body class="theme-puc">
	<section>
		<aside id="leftsidebar" class="sidebar"><?php include('informacao.php'); ?>
		</aside>
	</section>
	<section class="content"><?php include('menu.php'); ?>
		<div class="container-fluid">
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2 class="card-inside-title">Ranking - Trote Solidário</h2>
						</div>
						<script src="view/js/Validacaoform.js"></script>
						<div class="body"><?php while ($row = mysqli_fetch_array($rs)) { ?><?php $escola = $row['nome'];
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







