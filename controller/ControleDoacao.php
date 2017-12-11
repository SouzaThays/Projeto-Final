<?php

require_once("model/Doacao.php");

function Doacao($Processo) {

    switch ($Processo) {

        case 'incluir':

            $doacao = new Doacao();


            if (isset($_GET['cria']) == 'ok') {
                $doacao->incluir($_POST['fkEscola'],$_POST['fkBeneficiario'], $_POST['ListaidDonat'], $_POST['ListaQtd']);
            }

            break;

        case 'consultar':

            global $rs;

            $vdata = "";
            $vIdEscola = "";

            $doacao = new Doacao();

            if (isset($_GET['listarItens']) == "ok") {

                $doacao->consultar('select d.data data, d.fkEscola escola from doacao d where d.idDoacao = ' . $_GET['idDoacao'] .  ' ');

                $resultado = $doacao->Result;

                while ($vresultado = mysqli_fetch_array($resultado)) {
                    $vdata = $vresultado['data'];
                    $vIdEscola = $vresultado['escola'];
                }

                $doacao->consultar('
                    select don.nome, don.pontuacao pontu, d.quantidade, d.pontuacao, d.data
                    from doacao d , donativo don
                    where d.fkDonativo = don.idDonativo and d.data =  "' . $vdata . '" and d.fkEscola ='. $vIdEscola .'
                    order by d.data, don.nome');


                $rs = $doacao->Result;
            }else{
                $doacao->consultar( 'select d.idDoacao id, d.data, SUM(d.pontuacao) pontuacao, SUM(d.quantidade) quantidade, nome from doacao d, escola
                       where idEscola = fkEscola
                       group by d.data, nome
                        order by d.data, nome ; ');
                $rs = $doacao->Result;



            }

            break;



        case 'editar':

            global $rs;

            $doacao = new Doacao();

            $doacao->consultar("select * from doacaoo where idDoacao=" . $_GET['idDoacao']);
            $rs = $doacao->Result;

            if (isset($_POST['ok']) == "true") {
                $doacao->alterar($_POST['data'], $_POST['pontuacao'], $_GET['idDoacao']);
                echo '<script>alert("Alterado com sucesso !");</script>';
                echo '<script>window.location="lista_doacao.php?pg=listaDoacao";</script>';
            }

            break;

        case 'consultarRelatorio':

            global $rs;

            $doacao = new Doacao();

            if (isset($_GET['relat']) == 'doacao') {

                $_GET['vDtIni'] = explode("/", $_GET['vDtIni']);

                list($dia, $mes, $ano) = $_GET['vDtIni'];

                $dtIni = "$ano-$mes-$dia";


                $_GET['vDtFim'] = explode("/", $_GET['vDtFim']);

                list($dia, $mes, $ano) = $_GET['vDtFim'];

                $dtFim = "$ano-$mes-$dia";


                $doacao->consultar('select e.nome nomeEscola, don.nome, don.pontuacao, d.quantidade,
                                    d.pontuacao total, d.data from doacao d, escola e, donativo don
                                    where d.fkEscola = e.idEscola
                                    and d.fkDonativo = don.idDonativo
                                    and "' . $dtIni . '" <= d.data and "' . $dtFim . '" >= d.data');

            }


            $rs = $doacao->Result;

            break;



        case 'ranking':
            global $rs;

            $vdata = "";
            $vIdEscola = "";

            $doacao = new Doacao();

            if (isset($_GET['listarItens']) == "ok") {

                $doacao->consultar('select d.data data, d.fkEscola escola from doacao d where d.idDoacao = ' . $_GET['idDoacao'] .  ' ');

                $resultado = $doacao->Result;

                while ($vresultado = mysqli_fetch_array($resultado)) {
                    $vdata = $vresultado['data'];
                    $vIdEscola = $vresultado['escola'];
                }

                $doacao->consultar('
                    select don.nome, don.pontuacao pontu, d.quantidade, d.pontuacao, d.data
                    from doacao d , donativo don
                    where d.fkDonativo = don.idDonativo and d.data =  "' . $vdata . '" and d.fkEscola ='. $vIdEscola .'
                    order by d.data, don.nome');


                $rs = $doacao->Result;
            }else{
                $doacao->consultar('select  MAX(d.data), SUM(d.pontuacao), SUM(d.quantidade), nome
                                    from oep.doacao d, oep.escola
                                    where idEscola = fkEscola
                                    and Year(d.data) = Year(NOW())
                                    group by  nome
                                    order by SUM(d.pontuacao) DESC ; ');


                $rs = $doacao->Result;
            }

            break;





    }
}