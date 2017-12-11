<?php
require_once("model/Faq.php");
function Faq($Processo) {

    switch ($Processo) {

        case 'incluir':
            global $linha;
            global $rsFaq;
            $faq = new Faq();
            $_POST['login']= $_SESSION['login'];
            $logar = $_POST['login'];


            //$login->consultar('select * from oep.login where login LIKE "' . $logar . '" and senha LIKE "' . $senhaCod . '" ');
            $faq->consultar('select * from oep.pastoralista where login LIKE "' . $logar . '" ');
            $rsFaq = $faq->Result;

            while ($respParticipante = mysqli_fetch_array($rsFaq)) {
                $idPast = $respParticipante['idPastoralista'];
            }


            if (isset($_POST['okCadastrar']) == 'true') {
                $faq->incluir($_POST['ListaPergunta'], $_POST['ListaResposta'], $idPast);
            }
            break;



        case 'editar':

            global $rs;

            $faq = new Faq();

            $faq->consultar("select * from faq where idfaq=" . $_GET['idFaq']);
            $rs = $faq->Result;

            if (isset($_POST['ok']) == "true") {
                $faq->alterar($_POST['pergunta'], $_POST['resposta'], $_GET['idFaq']);
                echo '<script>alert("Alterado com sucesso !");</script>';
                echo '<script>window.location="lista_faq.php?pg=novoBen";</script>';
            }

            break;



        case 'consultar':

            global $rs;

            $faq = new Faq();

            $faq->consultar("select * from faq");
            $rs = $faq->Result;


            if (isset($_GET['ok']) == "true") {
                $faq->excluir($_GET['idFaq']);
                echo '<script>alert("Excluido com sucesso !");</script>';
                echo '<script>window.location="lista_faq.php?pg=lista";</script>';
            }

            break;


        case 'enviarEmail':

            global $linha;
            global $rs;
            $faq = new Faq();

            if (isset($_GET['enviar']) == 'email') {
                require_once('email/emailFaq.php');
            }

            break;

        case 'consultarRelatorio':

            global $rs;

            $faq = new Faq();

            if (isset($_GET['relat']) == 'faq') {


                $faq->consultar('SELECT  * FROM FAQ ');

            }


            $rs = $faq->Result;

            break;

    }
}