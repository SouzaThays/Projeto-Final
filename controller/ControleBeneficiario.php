<?php

require_once("model/Beneficiario.php");

function Beneficiario($Processo) {

    switch ($Processo) {

        case 'incluir':

            global $rs;

            $beneficiario = new Beneficiario();

            if (isset($_POST['ok']) == 'true') {
                $beneficiario->incluirBeneficiario($_POST['nome'], $_POST['telefone'], $_POST['nomeResponsavel'],$_POST['endereco']);
                echo '<script>alert("Cadastrado com sucesso !");</script>';
                echo '<script>window.location="lista_beneficiario.php?pg=novoBen";</script>';
            }

            break;

        case 'consultar':

            global $rsBeneficiario;

            $beneficiario = new Beneficiario();

            $beneficiario->consultar("select * from beneficiario");
            $rsBeneficiario = $beneficiario->Result;


            break;


        case 'editar':

            global $rs;

            $beneficiario = new Beneficiario();

            $beneficiario->consultar("select * from beneficiario where idBeneficiario=" . $_GET['idBeneficiario']);
            $rs = $beneficiario->Result;

            if (isset($_POST['ok']) == "true") {
                $beneficiario->alterar($_POST['nome'], $_POST['telefoneFixo'], $_POST['nomeResponsavel'],$_POST['endereco'], $_GET['idBeneficiario']);
                echo '<script>alert("Alterado com sucesso !");</script>';
                echo '<script>window.location="lista_beneficiario.php?pg=novoBen";</script>';
            }

            break;

        case 'consultarRelatorio':

            global $rs;

            $beneficiario = new Beneficiario();

            if (isset($_GET['relat']) == 'benef') {
                $beneficiario->consultar('select * from beneficiario');
            }


            $rs = $beneficiario->Result;

            break;
    }
}
