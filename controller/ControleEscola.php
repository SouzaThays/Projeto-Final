<?php

require_once("model/Escola.php");

function Escola($Processo)
{

    switch ($Processo) {

        case 'consultar':

            global $rsEscola;

            $escola = new Escola();

            $escola->consultar("select * from escola");
            $rsEscola = $escola->Result;

            break;
    }
}