<?php

require_once("model/Programa.php");


function Programa($Processo)
{

    switch ($Processo) {

        case 'consultar':

            global $rsPrograma;

            $programa = new Programa();

            $programa->consultar("select * from programa order by atuacao;");
            $rsPrograma = $programa->Result;

            break;
    }
}