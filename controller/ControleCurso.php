<?php

require_once("model/Curso.php");


function Curso($Processo)
{

    switch ($Processo) {

        case 'consultar':

            global $rs;

            $curso = new Curso();

            if (isset($_GET['pesquisar']) == 'ok') {
                $curso->consultar(' select * from escola e, curso c
                        where e.idEscola = c.fkEscola and idEscola =' . $_GET['idEscola'] . '
                            order by c.nome ');
                $rs = $curso->Result;
            }

            break;
    }
}