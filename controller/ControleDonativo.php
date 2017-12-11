<?php

require_once("model/Donativo.php");


function Donativo($Processo)
{

    switch ($Processo) {

        case 'incluir':

            global $rs;
            $donativo = new Donativo();


            if (isset($_GET['cria']) == 'ok') {
                $donativo->incluir($_POST['nome'],$_POST['pontuacao']);
                $rs = $donativo->Result;
            }

            break;

        case 'consultar':

            global $rsDonativo;

            $donativo = new Donativo();

            $donativo->consultar("select * from donativo order by nome");
            $rsDonativo = $donativo->Result;

            break;
    }
}