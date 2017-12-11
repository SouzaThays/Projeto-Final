<?php include('menu.php'); ?>

<?php
require_once('controller/ControleInscrito.php');
Inscrito('consultarInscritoPorProjeto');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>

    <script>
          $(function () {
              $("#tabs").tabs();
        });
        $.post('lista_projeto_tab_encerrado_imprimir.php', function (tabela) {
            $("#tdProjetos").html(tabela);
        });
        $.post('lista_pessoa_tab_imprimir.php', function (tabela) {
            $("#tbPessoas").html(tabela);
        });

        $.post('lista_projeto_declaracao_tabela.php', function (tabela) {
            $("#tdProjetosDecl").html(tabela);
        });

        $(document).ready(function () {
            var $seuCampoValor = $("#cpfPesqPessoa");
            $seuCampoValor.mask('000.000.000-00', {
                reverse: true,
            });			
			var $dataI = $("#dtInicio");
			$dataI.mask('00/00/0000', { reverse: false });

			var $dataF = $("#dtFim");
			$dataF.mask('00/00/0000', { reverse: false });
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
                                Relatório
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive">

                                <div id="tabs">
                                    <ul>
                                        <li><a href="#tabs-0">Relatórios por Pessoa</a></li>
                                        <li><a href="#tabs-1">Relatórios por Projeto</a></li>
                                        <li><a href="#tabs-2">Relatórios por Período</a></li>
                                        <li><a href="#tabs-3">Relatórios Gerais</a></li>
                                        <li><a href="#tabs-4">Relatório Enquete</a></li>
                                        <li><a href="#tabs-5">Declaração</a></li>
                                    </ul>

                                    <!--------------------------------------------------------------------------------------------------------------------------->
                                    <div id="tabs-0">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>

                                                        <p>
                                                            <b>Nome</b>
                                                        </p>
                                                        <input type="text" class="form-control " id="nomePesqPessoa" name="nomePesqPessoa">
                                                    </th>
                                                    <th>

                                                        <p>
                                                            <b>CPF</b>
                                                        </p>
                                                        <input type="text" class="form-control " id="cpfPesqPessoa" name="cpfPesqPessoa">
                                                    </th>
                                                    <th>
                                                        <p>
                                                            <b>Tipo de Cadastro</b>
                                                        </p>
                                                        <select class="form-control show-tick" id="tipoCadastro" name="tipoCadastro">
                                                            <option value="-1">Selecione</option>
                                                            <option value="1">Estudante</option>
                                                            <option value="2">Colaborador</option>
                                                            <option value="3">Organização Externa</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <i class="material-icons" style="cursor:pointer;" onclick="pesquisarFiltroPessoa()">search</i>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <!--------------------------------------------------------------------------------------------------------------------------->
                                        <div class="body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover dataTable ">
                                                    <thead>
                                                        <tr>

                                                            <th>Nome</th>
                                                            <th>CPF</th>
                                                            <th>E-mail</th>
                                                            <th>Telefone</th>
                                                            <th>Ação</th>
                                                        </tr>
                                                    </thead>

                                                    <!-- TABELA DE PROJETOS -->
                                                    <tbody id="tbPessoas"> </tbody>

                                                    <!--  -->

                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!--------------------------------------------------------------------------------------------------------------------------->
                                    <div id="tabs-1">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>

                                                        <p>
                                                            <b>Projeto</b>
                                                        </p>
                                                        <input type="text" class="form-control " id="nomePesq" name="nomePesq">
                                                    </th>

                                                    <th><?php
                                                    require_once('controller/ControlePlanejamento.php');
                                                    Planejamento('consultar');
                                                    ?>
                                                        <p>
                                                            <b>Planejamento</b>
                                                        </p>
                                                        <select class="form-control show-tick" id="fkPrPesq" name="fkPrPesq">
                                                            <option value="-1">Selecionar</option><?php while ($row1 = mysqli_fetch_array($rsPlanejamento)) { ?>
                                                            <option value="<?php echo $row1['idPlanejamento']; ?>"><?php echo $row1['descricao']; ?>
                                                            </option><?php } ?>
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
                                                            <option value="-1">Selecionar</option><?php while ($row2 = mysqli_fetch_array($rsPrograma)) { ?>
                                                            <option value="<?php echo $row2['idprograma']; ?>"><?php echo $row2['atuacao']; ?></option><?php } ?>
                                                        </select>

                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <!--------------------------------------------------------------------------------------------------------------------------->

                                        <div class="body">


                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover dataTable ">
                                                    <thead>
                                                        <tr>

                                                            <th>Relatório</th>
                                                            <th>Baixar</th>
                                                        </tr>
                                                    </thead>

                                                    <tr>
                                                        <td>
                                                            Projetos
                                                        </td>
                                                        <td>
                                                            <i class="material-icons" style="cursor:pointer;" onclick="abrirRelProjeto()">file_download</i>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            Relatório de Resposta Enquete
                                                        </td>
                                                        <td>
                                                            <i class="material-icons" style="cursor:pointer;" onclick="abrirRelEnquete()">file_download</i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Declaração de Presença
                                                        </td>
                                                        <td>
                                                            <i class="material-icons" style="cursor:pointer;" onclick="abrirRelEnquete()">file_download</i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Despesas
                                                        </td>
                                                        <td>
                                                            <i class="material-icons" style="cursor:pointer;" onclick="abrirRelDespesas()">file_download</i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Cracha
                                                        </td>
                                                        <td>
                                                            <i class="material-icons" style="cursor:pointer;" onclick="abrirRelCracha()">file_download</i>
                                                        </td>
                                                    </tr>


                                                </table>
                                            </div>
                                        </div>

                                        <!----------------------------------------------------------------------------------------------->
                                    </div>
                                    <div id="tabs-2">

                                        <!--------------------------------------------------------------------------------------------------------------------------->
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>

                                                        <p>
                                                            <b>Dada Início</b>
                                                        </p>
                                                        <input type="text" class="form-control datepickerIni" id="dtInicio" name="dtInicio">
                                                    </th>
                                                    <th>
                                                        <p>
                                                            <b>Dada Fim</b>
                                                        </p>
                                                        <input type="text" class="form-control datepickerFim" id="dtFim" name="dtFim">
                                                    </th>

                                                </tr>
                                            </thead>
                                        </table>
                                        <!--------------------------------------------------------------------------------------------------------------------------->
                                        <div class="body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover dataTable ">
                                                    <thead>
                                                        <tr>

                                                            <th>Relatório</th>
                                                            <th>Baixar</th>
                                                        </tr>
                                                    </thead>
                                                    <tr>
                                                        <td>
                                                            Relatório de Doações
                                                        </td>
                                                        <td>
                                                            <i class="material-icons" style="cursor:pointer;" onclick="abrirRelDoacoes()">file_download</i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Relatório de Inscritos
                                                        </td>
                                                        <td>
                                                            <i class="material-icons" style="cursor:pointer;" onclick="abrirRelInscPeriodo()">file_download</i>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="tabs-3">
                                        <div class="body">


                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover dataTable ">
                                                    <thead>
                                                        <tr>

                                                            <th>Relatório</th>
                                                            <th>Baixar</th>
                                                        </tr>
                                                    </thead>
                                                    <tr>
                                                        <td>Lista de Cadastros</td>
                                                        <td><i class="material-icons" style="cursor:pointer;" onclick="abrirRelCadastro()">file_download</i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lista de Acessos</td>
                                                        <td><i class="material-icons" style="cursor:pointer;" onclick="abrirRelAcesso()">file_download</i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lista de FAQ</td>
                                                        <td><i class="material-icons" style="cursor:pointer;" onclick="abrirRelfaq()">file_download</i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lista de Beneficiados</td>
                                                        <td><i class="material-icons" style="cursor:pointer;" onclick="abrirRelBenef()">file_download</i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Relatório Quantitativo</td>
                                                        <td>
                                                            <a href="download/relatorio_quantitativo.xlsx" download>
                                                                <i class="material-icons" style="cursor:pointer;">file_download</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Relatório Qualitativo</td>
                                                        <td>
                                                            <a href="download/relatorio_qualitativo.xlsx" download>
                                                                <i class="material-icons" style="cursor:pointer;">file_download</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--------------------------------------------------------------------------------->

                                    <div id="tabs-4">
                                        <div class="body">
                                            <ul class="list-group">

                                                <!--------------------------------------------------------------------------------------------------------------------------->
                                                <table class="table ">
                                                    <thead>
                                                        <tr>
                                                            <th>

                                                                <p>
                                                                    <b>Projeto</b>
                                                                </p>
                                                                <input type="text" class="form-control " id="nomePesqp" name="nomePesqp">
                                                            </th>

                                                            <th><?php
                                            require_once('controller/ControlePlanejamento.php');
                                            Planejamento('consultar');
                                            ?>
                                                                <p>
                                                                    <b>Planejamento</b>
                                                                </p>
                                                                <select class="form-control show-tick" id="fkPrPesqp" name="fkPrPesqp">
                                                                    <option value="-1">Selecionar</option><?php while ($row1 = mysqli_fetch_array($rsPlanejamento)) { ?>
                                                                    <option value="<?php echo $row1['idPlanejamento']; ?>"><?php echo $row1['descricao']; ?>
                                                                    </option><?php } ?>
                                                                </select>

                                                            </th>

                                                            <th><?php
                                            require_once('controller/ControlePrograma.php');
                                            Programa('consultar');
                                            ?>
                                                                <p>
                                                                    <b>Programa</b>
                                                                </p>
                                                                <select class="form-control show-tick" id="fkPrograPesqp" name="fkPrograPesqp">
                                                                    <option value="-1">Selecionar</option><?php while ($row2 = mysqli_fetch_array($rsPrograma)) { ?>
                                                                    <option value="<?php echo $row2['idprograma']; ?>"><?php echo $row2['atuacao']; ?></option><?php } ?>
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
                                                    <table class="table table-bordered table-striped table-hover dataTable ">
                                                        <thead>
                                                            <tr>

                                                                <th>Name</th>
                                                                <th>Data inicio</th>
                                                                <th>Data fim</th>
                                                                <th>Programa</th>
                                                                <!--<th>Status</th>-->
                                                                <th>Ação</th>
                                                            </tr>
                                                        </thead>

                                                        <!-- TABELA DE PROJETOS -->

                                                        <tbody id="tdProjetos"> </tbody>

                                                        <!--  -->


                                                    </table>
                                                </div>


                                            </ul>
                                        </div>
                                    </div>

                                    <!------------------------------------------------------------------->
                                    <div id="tabs-5">
                                        <div class="body">
                                            <table class="table ">
                                                <thead>
                                                    <tr>
                                                        <th>

                                                            <p>
                                                                <b>Nome Participante</b>
                                                            </p>
                                                            <input type="text" class="form-control " id="nomePesqD" name="nomePesqD">
                                                        </th>

                                                        <th><?php
                                                        require_once('controller/ControlePlanejamento.php');
                                                        Planejamento('consultar');
                                                        ?>
                                                            <p>
                                                                <b>Planejamento</b>
                                                            </p>
                                                            <select class="form-control show-tick" id="fkPrPesqD" name="fkPrPesqD">
                                                                <option value="-1">Selecionar</option><?php while ($row1 = mysqli_fetch_array($rsPlanejamento)) { ?>
                                                                <option value="<?php echo $row1['idPlanejamento']; ?>"><?php echo $row1['descricao']; ?>
                                                                </option><?php } ?>
                                                            </select>

                                                        </th>

                                                        <th><?php
                                                        require_once('controller/ControlePrograma.php');
                                                        Programa('consultar');
                                                        ?>
                                                            <p>
                                                                <b>Programa</b>
                                                            </p>
                                                            <select class="form-control show-tick" id="fkPrograPesqD" name="fkPrograPesqD">
                                                                <option value="-1">Selecionar</option><?php while ($row2 = mysqli_fetch_array($rsPrograma)) { ?>
                                                                <option value="<?php echo $row2['idprograma']; ?>"><?php echo $row2['atuacao']; ?></option><?php } ?>
                                                            </select>

                                                        </th>
                                                        <th>

                                                            <i class="material-icons" style="cursor:pointer;" onclick="pesquisarFiltroDeclaracao()">search</i>

                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <!--------------------------------------------------------------------------------------------------------------------------->
                                            <div id="msgDeclaracao"></div>


                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover dataTable ">
                                                    <thead>
                                                        <tr>

                                                            <th>Nome</th>
                                                            <th>Projeto</th>
                                                            <th>Data Inscrição</th>
                                                            <th>Status</th>
                                                            <th>Declaração</th>
                                                            <th>Crachá</th>
                                                        </tr>
                                                    </thead>

                                                    <!-- TABELA DE PROJETOS -->

                                                    <tbody id="tdProjetosDecl"> </tbody>

                                                    <!--  -->


                                                </table>
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
    <form id="formPesquisar"></form>
    <form id="formPesquisarPessoa"></form>
    <form id="formPesquisarDecl"></form>
</body>
</html>


<script>

    abreCracha = function (idInscrito, idProjeto) {
        $.post('relatorio_cracha.php?imprimir=ok&idInscrito=' + idInscrito + '&idProjeto=' + idProjeto + '', function (resposta) {

            var str = resposta;
            resposta = str.trim();

            if (resposta == "1") {
                $("#msgDeclaracao").html('<div class="alert bg-green alert-dismissible">Declaração salvo em "C:\ARQUIVOS" </div>');
            }

        });
    }

    abreDeclaracao = function (idInscrito,idProjeto) {

        $.post('relatorio_declaracao.php?imprimir=ok&idInscrito=' + idInscrito + '&idProjeto=' + idProjeto + '', function (resposta) {

            var str = resposta;
            resposta = str.trim();

            if (resposta == "1") {
                $("#msgDeclaracao").html('<div class="alert bg-green alert-dismissible">Declaração salvo em "C:\ARQUIVOS" </div>');
            } 
           
        });
    }


    pesquisarFiltroDeclaracao = function () {
        nome = document.getElementById("nomePesqD").value;
        projeto = document.getElementById("fkPrPesqD").value;
        programa = document.getElementById("fkPrograPesqD").value;



        $('<input/>', {
            type: 'hidden',
            name: 'nomeProjetoPesq',
            value: nome
        }).appendTo('#formPesquisarDecl');

        $('<input/>', {
            type: 'hidden',
            name: 'fkProjetoPesq',
            value: projeto
        }).appendTo('#formPesquisarDecl');

        $('<input/>', {
            type: 'hidden',
            name: 'fkProgramaPesq',
            value: programa
        }).appendTo('#formPesquisarDecl');

        var $form = $('#formPesquisarDecl');

        $.post('lista_projeto_declaracao_tabela.php?filtro=ok', $form.serialize(), function (tabela) {

            $("#tdProjetosDecl").html(tabela);
        });
    }

    //////////////

    pesquisarFiltro = function () {

        nome = document.getElementById("nomePesqD").value;
        projeto = document.getElementById("fkPrPesqD").value;
        programa = document.getElementById("fkPrograPesqD").value;

        alert(programa);

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

        $.post('lista_projeto_tab_encerrado_imprimir.php?filtro=ok', $form.serialize(), function (tabela) {

            $("#tdProjetos").html(tabela);
        });


    }

    pesquisarFiltroPessoa = function () {

        nome = document.getElementById("nomePesqPessoa").value;
        tipo = document.getElementById("tipoCadastro").value;
        CPF = document.getElementById("cpfPesqPessoa").value;

        $('<input/>', {
            type: 'hidden',
            name: 'nomeProjetoPesqPessoa',
            value: nome
        }).appendTo('#formPesquisarPessoa');

        $('<input/>', {
            type: 'hidden',
            name: 'CPFProjetoPesqPessoa',
            value: CPF
        }).appendTo('#formPesquisarPessoa');

        $('<input/>', {
            type: 'hidden',
            name: 'tipoPesqPessoa',
            value: tipo
        }).appendTo('#formPesquisarPessoa');

        var $form = $('#formPesquisarPessoa');

        $.post('lista_pessoa_tab_imprimir.php?filtro=ok', $form.serialize(), function (tabela) {
            $("#tbPessoas").html(tabela);
        });


    }

    abrirRelInscritos = function () {

        vNomePesq = document.getElementById('nomePesq').value;
        vPlanejamento = document.getElementById('fkPrPesq').value;
        vPrograma = document.getElementById('fkPrograPesq').value;

         window.location.replace('relatorio_inscritos.php?relat=inscrit&vNomePesq=' + vNomePesq + '&vPlanejamento=' + vPlanejamento + '&vPrograma=' + vPrograma +'');
    }

    abrirRelDespesas = function () {

        vNomePesq = document.getElementById('nomePesq').value;
        vPlanejamento = document.getElementById('fkPrPesq').value;
        vPrograma = document.getElementById('fkPrograPesq').value;

        window.location.replace('relatorio_despesas.php?relat=despesa&vNomePesq=' + vNomePesq + '&vPlanejamento=' + vPlanejamento + '&vPrograma=' + vPrograma + '');
    }

    abrirRelProjeto = function () {

        vNomePesq = document.getElementById('nomePesq').value;
        vPlanejamento = document.getElementById('fkPrPesq').value;
        vPrograma = document.getElementById('fkPrograPesq').value;

        window.location.replace('relatorio_projetos.php?relat=projeto&vNomePesq=' + vNomePesq + '&vPlanejamento=' + vPlanejamento + '&vPrograma=' + vPrograma + '');
    }

    abrirRelDoacoes = function () {

        vDtIni = document.getElementById('dtInicio').value;
        vDtFim = document.getElementById('dtFim').value;

        window.location.replace('relatorio_doacoes.php?relat=doacao&vDtIni=' + vDtIni + '&vDtFim=' + vDtFim + '');
    }

    abrirRelInscPeriodo = function () {

        vDtIni = document.getElementById('dtInicio').value;
        vDtFim = document.getElementById('dtFim').value;

        window.location.replace('relatorio_inscritos_por_periodo.php?relat=inscPeriod&vDtIni=' + vDtIni + '&vDtFim=' + vDtFim + '');
    }

    abrirRelCracha = function () {

        window.location.replace('relatorio_cracha.php?');
    }

    abrirRelPessoal = function (id) {
       // alert(id);
       window.location.replace('relatorio_dados_pessoais_contato.php?relat=pessoas&idPessoa=' + id + '');
    }

    abrirRelContato = function (id) {

        window.location.replace('relatorio_dados_contato.php?relat=contato&idPessoa=' + id + '');
    }

    abrirRelEnquete = function (id) {
        window.location.replace('relatorio_enquete.php?relat=enquete&idProjeto=' + id + '');
    }

    abrirRelfaq = function () {
        window.location.replace('relatorio_faq.php?relat=faq');
    }

    abrirRelCadastro = function () {

        window.location.replace('relatorio_cadastros.php?relat=cadastro');
    }

    abrirRelBenef = function () {

        window.location.replace('relatorio_beneficiarios.php?relat=benef');
    }

    abrirRelAcesso = function () {

        window.location.replace('relatorio_acesso.php?relat=acesso');
    }

    $(function () {
        $(".datepickerIni").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true
        }).bind("change", function () {
            var minValue = $(this).val();

            minValue = $.datepicker.parseDate("dd/mm/yy", minValue);
            minValue.setDate(minValue.getDate());
            $(".datepickerIni").datepicker("option", "minDate", minValue);
            })

        $(".datepickerFim").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true
        }).bind("change", function () {
            var minValue = $(this).val();

            minValue = $.datepicker.parseDate("dd/mm/yy", minValue);
            minValue.setDate(minValue.getDate());
            $(".datepickerFim").datepicker("option", "minDate", minValue);
        })

    });

</script>

