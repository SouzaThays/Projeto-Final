<?php include('menu.php'); ?>

<?php

    require_once('controller/ControleDonativo.php');
    Donativo('incluir');

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
                            <h2 class="card-inside-title">Novo Donativo</h2>
                        </div>
                        <script src="view/js/Validacaoform.js"></script>
                        <div class="body">
  
                            <form id="conteudo">
                                <div class="demo-masked-input">
                                    <div class="row clearfix">

                                        <div class="col-md-6">
                                            <b>Donativo*</b>
                                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome " />
                                        </div>



                                        <div class="col-md-6">
                                            <b>Pontuação*</b>
                                            <input type="number" class="form-control" id="pontuacao" name="pontuacao" placeholder="Pontuacao " />
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

    cadastrar = function () {

        var $form = $('#conteudo');

        $.post('novo_donativo.php?cria=ok', $form.serialize(), function (resposta) {
            alert("Cadastrado com sucesso !");
        });
        

    }
        

</script>


