<?php
require_once("model/Projeto.php");
require_once("model/Inscrito.php");
require_once("model/Participante.php");
require_once("model/Pessoa.php");

function Inscrito($Processo) {

    switch ($Processo) {

        case 'incluir':

            $inscrito = new Inscrito();
            $participante = new Participante();
            $projeto = new Projeto();
            $pessoa = new Pessoa();

            $contInsc = 0;
            $idPart = 0;

            if (isset($_GET['inscricao']) == "incluir") {


                $pessoa->consultar('select cpf from pessoa where cpf = "' . $_GET['cpf'] . '" ');
                $rsPessoa = $pessoa->Result;

                $contPessoa = $rsPessoa->num_rows;

                if($contPessoa <= 0){
                    echo '-1';
                    break;
                }


                //valida se a pessoa da inscrição existe
                $participante->consultar('select idParticipante from participante, pessoa where cpf = "' . $_GET['cpf'] . '" and DataInicio <= NOW() AND DataFim is null and idUsuario=fkUsuario');
                $rs = $participante->Result;

                while ($respParticipante = mysqli_fetch_array($rs)) {
                    $idPart = $respParticipante['idParticipante'];
                }
                $contPart = $rs->num_rows;

                if($contPart <= 0){
                    $participante->incluir($_GET['cpf']);
                }else{

                    $inscrito->consultar('select idInscrito from inscricao where fkParticipante = "' . $idPart . '" and fkProjeto = "' . $_GET['idProjeto'] . '" ');
                    $rsInsc = $inscrito->Result;
                    $contInsc = $rsInsc->num_rows;
                }

                //while ($respInscrit = mysqli_fetch_array($rsInsc)) {
                if($contInsc > 0){
                    echo '0';
                    break;
                }
                $inscrito->incluir($_GET['idProjeto'],$_GET['cpf']);
                $projeto->atualizarVaga($_GET['idProjeto']);
                echo '1';
                

            }

            break;

        case 'consultarInscritoPorProjeto':

            global $rs;

            $projeto = new Projeto();

            $projeto->consultar('SELECT inscricao.dataInscricao, pessoa.rg , pessoa.nome,  pessoa.cpf, inscricao.statusTaxa, pessoa.idUsuario, pessoa.email, inscricao.idInscrito
                                FROM  oep.inscricao, oep.projeto, oep.participante, oep.pessoa
                                where inscricao.fkProjeto = projeto.idProjeto
                                AND  inscricao.fkParticipante = participante.idParticipante
                                AND participante.fkUsuario = pessoa.idUsuario
                                AND  projeto.idProjeto = "' . $_GET['idProjeto'] .'" ');

            $rs = $projeto->Result;


            if (isset($_GET['cria']) == 'email') {
                $_POST['ListaEmail'];
                require_once('email/emailEnquete.php');
            }


            break;

        case 'consultarDadosPessoais':

            global $rs;

            $pessoa = new Pessoa();

            $pessoa->consultar('SELECT *
                                FROM  pessoa where idUsuario = "' . $_GET['idPessoa'] .'" ');

            $rs = $pessoa->Result;

            break;

        case 'consultExcluir':

            global $rs;

            $pessoa = new Pessoa();

            if (isset($_GET['cancel']) == 'ok') {

                $pessoa->consultar('update inscricao set status= "Cancelado", dataFim= NOW()
                         where idInscrito="' . $_GET['idEx'] . '" ' );

                echo '0';
            }

            $pessoa->consultar(' select p.nome nome, p.cpf cpf,  insc.dataInscricao dtInscricao, proj.dataInicio
                            dtProjeto, proj.nome ativ, insc.idInscrito id, part.idParticipante idPart
                from pessoa p , participante part, inscricao insc, projeto proj
                where p.idUsuario = part.fkUsuario
                and part.idParticipante = insc.fkParticipante
                and insc.fkProjeto = proj.idProjeto and proj.dataFim > now()
                and p.cpf = "' . $_POST['CPF'] .'" and  insc.status = "Ativo" ');

            $rs = $pessoa->Result;

            break;
/*******************************************************************************/

        case 'consultarRelatoriosPorPeriodo':

            global $rs;

            $pessoa = new Pessoa();

            if (isset($_GET['relat']) == 'inscPeriod') {


                $_GET['vDtIni'] = explode("/", $_GET['vDtIni']);

                list($dia, $mes, $ano) = $_GET['vDtIni'];

                $dtIni = "$ano-$mes-$dia";


                $_GET['vDtFim'] = explode("/", $_GET['vDtFim']);

                list($dia, $mes, $ano) = $_GET['vDtFim'];

                $dtFim = "$ano-$mes-$dia";

                $pessoa->consultar('SELECT insc.dataInscricao, pes.rg rg , pes.nome nome,  pes.cpf cpf, insc.statusTaxa,
					            pes.idUsuario, pes.email email, insc.idInscrito, proj.nome nomeProj,
					            proj.fkPlanejamento fkPlan, proj.fkprograma programa, insc.status status, pes.telefoneCelular telCel,
                                proj.local local, proj.dataInicio dtIni, proj.dataFim dtFim, insc.dataInscricao dtInsc
					            FROM  inscricao insc, projeto proj, participante part, pessoa pes
                                where insc.fkProjeto = proj.idProjeto
                                AND  insc.fkParticipante = part.idParticipante
                                AND part.fkUsuario = pes.idUsuario
                                AND "' . $dtIni . '" <= insc.dataInscricao and "' . $dtFim . '" >= insc.dataInscricao

                                ');

            }


            $rs = $pessoa->Result;

            break;
        case 'consultarRelatorios':

            global $rs;

            $pessoa = new Pessoa();

            if (isset($_GET['relat']) == 'inscrit') {


                $strNome = $_GET['nomeProjetoPesq'];
                $strNome = "%".$strNome."%";

                $pessoa->consultar('SELECT insc.dataInscricao, pes.rg rg , pes.nome nome,  pes.cpf cpf, insc.statusTaxa,
					            pes.idUsuario, pes.email email, insc.idInscrito, proj.nome nomeProj,
					            proj.fkPlanejamento fkPlan, proj.fkprograma programa, insc.status status, pes.telefoneCelular telCel,
                                proj.local local, proj.dataInicio dtIni, proj.dataFim dtFim, insc.dataInscricao dtInsc
					            FROM  inscricao insc, projeto proj, participante part, pessoa pes
                                where insc.fkProjeto = proj.idProjeto
                                AND  insc.fkParticipante = part.idParticipante
                                AND part.fkUsuario = pes.idUsuario
                                AND (proj.nome like "' . $strNome . '" or "' . $_GET['nomeProjetoPesq'] . '"  is null )
                                AND (proj.fkPlanejamento = "' . $_GET['vPlanejamento'] . '" or "' . $_GET['vPlanejamento'] . '" = "-1" )
                                AND (proj.fkprograma = "' . $_GET['vPrograma'] . '" or "' . $_GET['vPrograma'] . '" = "-1" )');

            }


            $rs = $pessoa->Result;

            break;

    }
}