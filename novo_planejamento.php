<?php include('menu.php'); ?>

<?php

    require_once('controller/ControlePlanejamento.php');
    Planejamento('incluir');

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
                            <h2 class="card-inside-title">Novo Planejamento</h2>
                        </div>
                        <script src="view/js/Validacaoform.js"></script>
                        <div class="body">
  
                            <form id="conteudo">

                                <div class="demo-masked-input">
                                    <div class="row clearfix">

                                        <div class="col-md-6">
                                            <b>Nome *</b>
                                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Nome " required />
                                        </div>


                                        <div class="col-md-2">
                                            <b>Ano *</b>
                                            <input type="number" class="form-control" id="ano" name="ano" placeholder="Ano " required />
                                        </div>

                                        <div class="col-md-2">
                                            <b>Data inicio *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class=" date form-control " id="dataInicio" name="dataInicio" placeholder="01/01/2017" required />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <b>Data fim *</b>
                                            <div>
                                                <div class="form-line">
                                                    <input type="text" class="form-control date" id="dataFim" name="dataFim" placeholder="01/01/2017" required />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>


                            <div class="button-demo">
                                <input type="submit" name="button" id="button" value="Cadastrar" class="btn btn-danger waves-effect" onclick="cadastrar()" />
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


    cadastrar = function () {

        var $form = $('#conteudo');

        $.post('novo_planejamento.php?pg=NovoPlanejamento&cadastrar=true', $form.serialize(), function (resposta) {
            alert("Cadastrado com sucesso !");
        });
        

    }
        

</script>


