<?php

require_once("model/Planejamento.php");

function Planejamento($Processo)
{

    switch ($Processo) {

        case 'consultar':

            global $rsPlanejamento;

            $planejamento = new Planejamento();

            $planejamento->consultar("select * from planejamento order by ano, descricao ");

            $rsPlanejamento = $planejamento->Result;


            break;

        case 'consultarAtivos':

            global $rsPlanejamento;

            $planejamento = new Planejamento();

            $planejamento->consultar("select * from planejamento p where p.dataFim >= now() order by ano, descricao ");

            $rsPlanejamento = $planejamento->Result;


            break;

            case 'incluir':


            $planejamento = new Planejamento();

            if (isset($_GET['cadastrar']) == 'true') {


                $_POST['dataInicio'] = explode("/", $_POST['dataInicio']);

                list($dia, $mes, $ano) = $_POST['dataInicio'];

                $_POST['dataInicio'] = "$ano-$mes-$dia";


                $_POST['dataFim'] = explode("/", $_POST['dataFim']);

                list($dia, $mes, $ano) = $_POST['dataFim'];

                $_POST['dataFim'] = "$ano-$mes-$dia";

                $planejamento->incluir( $_POST['descricao'], $_POST['ano'], $_POST['dataInicio'], $_POST['dataFim']);


            }


            break;
    }
}