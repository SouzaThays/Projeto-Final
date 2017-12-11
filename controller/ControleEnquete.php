<?php

require_once("model/Alternativa.php");
require_once("model/pergunta.php");
require_once("model/Enquete.php");
require_once("model/Projeto.php");
require_once("model/Inscrito.php");
require_once("model/Participante.php");
require_once("model/Pessoa.php");
require_once("model/Resposta.php");

function Enquete($Processo) {



    switch ($Processo) {

        case 'editarData':
            global $rsData;
            $projeto = new Projeto();
            global $rsEnquete;
            $enquete = new Enquete();

            $enquete->consultar("select DISTINCT inicio, fim from projeto, enquete where idProjeto=" . $_GET['idProjeto'] . " and fkProjeto = idProjeto and inicio IS NOT NULL");
            $rsData = $enquete->Result;



            $projeto->consultar("select idEnquete from projeto, enquete where idProjeto=" . $_POST['idProjeto'] . " and fkProjeto = idProjeto");
            $rsEnquete = $projeto->Result;



            //$respParticipante = mysqli_fetch_array($rsData);
            //$idPart = $respParticipante['inicio'];


            $_POST['dateInicio'] = explode("/", $_POST['dateInicio']);

            list($dia, $mes, $ano) = $_POST['dateInicio'];

            $_POST['dateInicio'] = "$ano-$mes-$dia";


            $_POST['dateFim'] = explode("/", $_POST['dateFim']);

            list($dia, $mes, $ano) = $_POST['dateFim'];

            $_POST['dateFim'] = "$ano-$mes-$dia";


            while (mysqli_fetch_array($rsEnquete)) {

                if (isset($_GET['data']) == 'ok') {
                    $enquete->alterar( $_POST['dateInicio'], $_POST['dateFim'],  $_POST['idProjeto'] );

                }
            }

            break;



        case 'incluirEnquete':
            global $linha;
            global $rsEnquete;
            $enquete = new Enquete();
            global $rs;
            $projeto = new Projeto();

            $_POST['dateInicio'] = explode("/", $_POST['dateInicio']);

            list($dia, $mes, $ano) = $_POST['dateInicio'];

            $_POST['dateInicio'] = "$ano-$mes-$dia";


            $_POST['dateFim'] = explode("/", $_POST['dateFim']);

            list($dia, $mes, $ano) = $_POST['dateFim'];

            $_POST['dateFim'] = "$ano-$mes-$dia";



            $projeto->consultar("select * from projeto where idProjeto=" . $_GET['idProjeto']);
            $rs = $projeto->Result;

            $projeto->consultar("select * from projeto where idProjeto=" . $_GET['idProjeto']);
            $rs = $projeto->Result;


            if (isset($_GET['cria']) == 'ok') {
                $enquete->incluirEnquete($_POST['fkPergunta'],$_POST['ListaAlternativa'], $_POST['idProjeto'], $_POST['dateInicio'], $_POST['dateFim']);
            }


            break;

        case 'incluirPergunta':

            global $linha;
            global $rsPergunta;
            $pergunta = new Pergunta();
            if (isset($_POST['okCadastrar']) == 'true') {
                $pergunta->incluirPergunta($_POST['ListaPergunta']);
                echo '<script>alert("Cadastrado com sucesso !");</script>';
                echo '<script>window.location="lista_pergunta.php?pg=listaPergunta";</script>';
            }

            break;


        case 'incluirResposta':

            global $linha;
            global $rsAlternativa;
            $alternativa = new Alternativa();
            if (isset($_POST['okCadastrar']) == 'true') {
                $alternativa->incluirAlternativa($_POST['ListaAlternativa']);
                echo '<script>alert("Cadastrado com sucesso !");</script>';
                echo '<script>window.location="lista_alternativa.php?pg=listaResposta";</script>';
            }

            break;

        case 'consultarPergunta':

            global $rsPergunta;
            $pergunta = new Pergunta();
            if (isset($_GET['excluir']) == "ok") {
                $pergunta->excluir($_GET['idPergunta']);
            }
            $pergunta->consultar("Select * from perguntas");
            $rsPergunta = $pergunta->Result;
            break;


        case 'consultarPerguntasInseridas':

            global $rsPergunta;
            $pergunta = new Pergunta();
            global $rs;
            $projeto = new Projeto();
            $projeto->consultar("select * from projeto where idProjeto=" . $_GET['idProjeto']);
            $rs = $projeto->Result;
            if (isset($_GET['excluir']) == "ok") {
                $pergunta->excluir($_GET['idPergunta']);
            }
            $pergunta->consultar("Select DISTINCT enquete.fkPerguntas,  perguntas.descricao, perguntas.idPerguntas
                                from oep.perguntas, oep.enquete, oep.projeto
                                where enquete.fkProjeto = " . $_GET['idProjeto']."
                                and enquete.fkProjeto = projeto.idProjeto
                                and perguntas.idPerguntas = enquete.fkPerguntas");
            $rsPergunta = $pergunta->Result;
            global $rsEnquete;
            $enquete = new Enquete();

            if (isset($_GET['excluir']) == "ok") {
                $enquete->excluir($_GET['fkEnquete']);
            }
            break;



        case 'consultarAlternativa':

            global $rsAlternativa;
            $alternativa = new Alternativa();
            $pergunta = new Pergunta();
            if (isset($_GET['pesquisar']) == "ok") {
                $alternativa->consultar("Select * from oep.alternativas where idAlternativas not in (select enquete.fkAlternativas from oep.enquete where enquete.fkProjeto = " . $_GET['idProjeto'] ." and enquete.fkPerguntas =" . $_GET['idPergunta'] . ")");
                $rsAlternativa = $alternativa->Result;
            }
            if (isset($_GET['excluir']) == "ok") {
                $alternativa->excluir($_GET['idAlternativa']);
            }
            break;


        case 'consultarTodasAlternativa':

            global $rsAlternativa;
            $alternativa = new Alternativa();


            $alternativa->consultar("Select * from alternativas");
            $rsAlternativa = $alternativa->Result;

            break;


        case 'consultarEnquete':

            global $rsEnquete;
            $enquete = new Enquete();
            if (isset($_GET['excluir']) == "ok") {
                $enquete->excluir($_GET['idAlternativa']);
            }
            $enquete->consultar("select DISTINCT projeto.idProjeto, perguntas.descricao from oep.enquete, oep.perguntas, oep.projeto where enquete.fkPerguntas = perguntas.idPerguntas and projeto.idProjeto =". $_GET['idProjeto'] );
            $rsEnquete = $enquete->Result;
            break;


        case 'excluirAlternativaEnq':

            global $rsEnquete;
            $enquete = new Enquete();
            if (isset($_GET['excluir']) == "ok") {
                $enquete->excluir($_GET['idEnquete']);
            }
            break;

        case 'consultarAlternativaPorEnquete':

            global $rsEnquete;
            $alternativa = new Alternativa();
            $alternativa->consultar("select * from alternativas, enquete where alternativas.idAlternativas = enquete.fkAlternativas and enquete.fkPerguntas = " . $_GET['idPergunta'] . " and enquete.fkProjeto = " . $_GET['idProjeto'] );
            $rsEnquete = $alternativa->Result;
            $enquete = new Enquete();
            if (isset($_GET['excluir']) == "ok") {
                $enquete->excluir($_GET['idEnquete']);
            }
            break;


        case 'listarEnquete':

            global $rsEnquetePergunta;
            global $rsEnqueteAlt;
            $enquete = new Enquete();
            $projeto = 7;
            $enquete->consultar("SELECT * FROM oep.enquete, oep.alternativas, oep.perguntas, oep.projeto where enquete.fkProjeto = projeto.idProjeto and enquete.fkPerguntas = perguntas.idPerguntas and enquete.fkProjeto = ".$_GET['idProjeto']." and enquete.fkProjeto = projeto.idProjeto and enquete.fkAlternativas = alternativas.idAlternativas ORDER BY fkPerguntas");
            $rsEnquetePergunta = $enquete->Result;
            break;

        case 'listar':

            global $rs;
            $enquete = new Enquete();
            $projeto = 7;
            $enquete->consultar("SELECT DISTINCT enquete.fkPerguntas, perguntas.descricao FROM oep.enquete, oep.alternativas, oep.perguntas, oep.projeto where enquete.fkProjeto = projeto.idProjeto and enquete.fkPerguntas = perguntas.idPerguntas and enquete.fkProjeto = ".$_GET['idProjeto']." and enquete.fkProjeto = projeto.idProjeto and enquete.fkAlternativas = alternativas.idAlternativas ORDER BY fkPerguntas");
            $rs = $enquete->Result;
            break;




        case 'incluirRespostaParticipante':

            $inscrito = new Inscrito();
            $participante = new Participante();
            $projeto = new Projeto();
            $pessoa = new Pessoa();
            $Resposta = new Resposta();

            $contInsc = 0;
            $idPart = 0;

            if (isset($_GET['inscricao']) == "incluir") {

                // VALIDA SE CPF EXISTE
                $pessoa->consultar('select cpf from pessoa where cpf = "' . $_GET['cpf'] . '" ');
                $rsPessoa = $pessoa->Result;

                $contPessoa = $rsPessoa->num_rows;

                if($contPessoa <= 0){
                    echo '-1';
                    break;
                }






                // VALIDA SE CPF EXISTE
                $participante->consultar('select idUsuario from oep.pessoa where cpf = "' . $_GET['cpf'] . '" ');
                $rs = $participante->Result;
                $respParticipante = mysqli_fetch_array($rs);
                $idPart = $respParticipante['idUsuario'];
                $_POST['idPessoa'] = $idPart;


                //VALIDA SE SE PARTICIPOU DO PROJETO
                $inscrito->consultar('select idInscrito from oep.pessoa, oep.participante, oep.inscricao, oep.projeto
                where fkUsuario = "' . $_POST['idPessoa'] . '"
                and fkUsuario = idUsuario
                and fkProjeto = "' . $_GET['idProjeto'] . '"
                and idProjeto = fkProjeto
                and fkParticipante = idParticipante;');
                $rsInscrito = $inscrito->Result;
                $respInscrito = mysqli_fetch_array($rsInscrito);
                $idInscrito = $respInscrito['idInscrito'];
                $_POST['idInscrito'] = $idInscrito;
                $contPessoaParticiparam = $rsInscrito->num_rows;

                if($contPessoaParticiparam <= 0){
                    echo '0';
                    break;
                }




                //VALIDA SE JÁ PREENCHEU A ENQUETE
                $Resposta->consultar('select idInscrito, idResposta from oep.inscricao,  oep.resposta where idInscrito =  "' . $_POST['idInscrito'] . '" and idInscrito = fkInscrito');
                $rsResposta = $Resposta->Result;
                $contPessoaResponderam = $rsResposta->num_rows;

                if($contPessoaResponderam > 0){
                    echo '-2';
                    break;
                }else{
                    echo '1';
                }





                //$contPart = $rs->num_rows;

                // if($contPart >= 0){
                //    echo '0';
                // }else{

                //  $inscrito->consultar('select idInscrito from inscricao where fkParticipante = "' . $idPart . '" and fkProjeto = "' . $_GET['idProjeto'] . '" ');
                // $rsInsc = $inscrito->Result;
                // $contInsc = $rsInsc->num_rows;
                // }

                //while ($respInscrit = mysqli_fetch_array($rsInsc)) {
                // if($contInsc > 0){
                //     echo '0';
                //    break;
                //}
                //$inscrito->incluir($_GET['idProjeto'],$_GET['cpf']);
                //$projeto->atualizarVaga($_GET['idProjeto']);
                //echo '1';
                // AQUI TEM QUE IMPRIMIR A TAXA SE TIVER

            }

            break;


        case 'incluirRespostaEnq':
            global $rsResposta;
            $resposta = new Resposta();
            $participante = new Participante();
            $inscrito = new Inscrito();

            $id=$_POST['idInsc'];

            echo $id;
            $participante->consultar('select idUsuario from oep.pessoa where cpf = "' . $id. '" ');
            $rs = $participante->Result;
            $respParticipante = mysqli_fetch_array($rs);
            $idPart = $respParticipante['idUsuario'];
            $_POST['idPessoa'] = $idPart;


            $inscrito->consultar('select idInscrito from oep.pessoa, oep.participante, oep.inscricao, oep.projeto
                where fkUsuario = "' . $_POST['idPessoa'] . '"
                and fkUsuario = idUsuario
                and fkProjeto = "' . $_POST['idProjeto'] . '"
                and idProjeto = fkProjeto
                and fkParticipante = idParticipante;');
            $rsInscrito = $inscrito->Result;
            $respInscrito = mysqli_fetch_array($rsInscrito);
            $idInscrito = $respInscrito['idInscrito'];
            $_POST['idInscrito'] = $idInscrito;


            // $_POST['idProjeto'] = $idPart;

            if (isset($_GET['cria']) == 'ok') {

                $resposta->incluirRespostaEnq($_POST['idProjeto'], $_POST['idInscrito'], $_POST['fkEnquete'], $_POST['listaPergunta'], $_POST['listaAlternativa']);
            }
            break;

        case 'enviarEmail':


            global $rs;
            $enquete = new Enquete();
            $projeto = 7;
            $enquete->consultar("SELECT DISTINCT enquete.fkPerguntas, perguntas.descricao FROM oep.enquete, oep.alternativas, oep.perguntas, oep.projeto where enquete.fkProjeto = projeto.idProjeto and enquete.fkPerguntas = perguntas.idPerguntas and enquete.fkProjeto = ".$_GET['idProjeto']." and enquete.fkProjeto = projeto.idProjeto and enquete.fkAlternativas = alternativas.idAlternativas ORDER BY fkPerguntas");
            $rs = $enquete->Result;

            break;

        case 'consultarRelatorio':

            global $rs;

            $enquete = new Enquete();

            if (isset($_GET['relat']) == 'enquete') {


                $enquete->consultar('SELECT  proj.nome nomeProj, pes.nome nome, perg.descricao pergunta, al.descricaoAlt resposta
                                FROM  inscricao insc, projeto proj, participante part, pessoa pes,
                                resposta resp, perguntas perg, alternativas al
                                where insc.fkProjeto = proj.idProjeto
                                AND  insc.fkParticipante = part.idParticipante
                                AND part.fkUsuario = pes.idUsuario
                                AND resp.fkInscrito = insc.idInscrito and resp.fkProjeto = proj.idProjeto
                                AND perg.idPerguntas = resp.fkPerguntas and al.idAlternativas = resp.fkAlternativas

                                AND (proj.idProjeto = "' . $_GET['idProjeto'] . '"  )');

            }


            $rs = $enquete->Result;

            break;

    }

}