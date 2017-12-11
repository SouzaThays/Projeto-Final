<?php include('menu.php');



      require_once('controller/ControleEnquete.php');
      Enquete('editarData');



      require_once('controller/ControleEnquete.php');
      Enquete('consultarAlternativa');

      require_once('controller/ControleEnquete.php');
      Enquete('consultarPergunta');


      require_once('controller/ControleEnquete.php');
      Enquete('incluirEnquete');


      require_once('controller/ControleEnquete.php');
      Enquete('consultarEnquete');

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
                            <h2 class="card-inside-title">Data vigência</h2>
                        </div>
                        <script src="view/js/Validacaoform.js"></script>
                        <div class="body">
                            <form id="form">

                                <?php while ($row3 = mysqli_fetch_array($rs)) { ?>

                                <div>
                                    <div class="form-line">
                                        <input type="hidden" class="form-control " name="idProjeto" id="idProjeto" value="<?php echo $row3['idProjeto']; ?>" />
                                    </div>
                                </div><?php  }?>

                                <?php while ($row4 = mysqli_fetch_array($rsData)) { ?>

                                <?php


                                          $data_atual = date("Y-m-d");
                                          $valida = "";
                                          $inicio = $row4['inicio'];

                                          if($inicio < $data_atual){

                                              $valida = "style='display: block;'";
                                              $bloqueado = "style='display: none;'";
                                              //$valida = "disabled'";
                                          }
                                          else{
                                              $bloqueado = "style='display: block;'";
                                              $valida = "style='display: none;'";
                                          }

                                          if($inicio != "0000-00-00"){ ?>





                                <div class="demo-masked-input">
                                    <div class="row clearfix">
                                        <div class="col-md-2" <?php echo $bloqueado; ?>>
                                            <b>Data Inicio *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class=" date form-control " id="dateInicio" name="dateInicio" placeholder="Ex: 30/07/2016" value="<?php echo date("d/m/Y", strtotime( $row4['inicio'])); ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2" <?php echo $valida; ?>>
                                            <b>Data Inicio *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class=" date form-control " id="dateInicio" name="dateInicio" placeholder="Ex: 30/07/2016" value="<?php echo date("d/m/Y", strtotime( $row4['inicio'])); ?>" disabled />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <b>Data Fim *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class=" date form-control " id="dateFim" name="dateFim" placeholder="Ex: 30/07/2016" value="<?php echo date("d/m/Y", strtotime( $row4['fim'])); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <?php
                                          }
                                      }

                                      $cont = $rsData->num_rows;

                                      if($inicio == "0000-00-00" || $cont == 0){ ?>
                                <div class="col-md-2">
                                    <b>Data Inicio *</b>
                                    <div>
                                        <div class="form-line">
                                            <input type="text" class=" date form-control " id="dateInicio" name="dateInicio" placeholder="Ex: 30/07/2016" value="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <b>Data Fim *</b>
                                    <div>
                                        <div class="form-line">
                                            <input type="text" class=" date form-control " id="dateFim" name="dateFim" placeholder="Ex: 30/07/2016" value="" />
                                        </div>
                                    </div>
                                </div>
                                <?php  }

								?>


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
        $.post('lista_proj_encerrados_data.php?data=ok', $form.serialize(), function (resposta) {

            alert("Cadastrado com sucesso !");

        });
        var idProjeto = $('#idProjeto').val();
        window.location.href = 'lista_alternativa_pergunta.php?pesquisar=ok&idProjeto=' + idProjeto;
    }

</script>


