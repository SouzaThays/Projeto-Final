<?php
require_once("model/Depoimento.php");
require_once("model/Inscrito.php");
require_once("model/Participante.php");
require_once("model/Pessoa.php");
function Depoimento($Processo) {
    switch ($Processo) {
        case 'incluir':
            $depoimento = new Depoimento();
            $participante = new Participante();
            $pessoa = new Pessoa();
            if (isset($_GET['inscricao']) == "incluir") {
                $pessoa->consultar('select cpf from pessoa where cpf = "' . $_GET['cpf'] . '" ');
                $rsPessoa = $pessoa->Result;
                $contPessoa = $rsPessoa->num_rows;
                //se a pessoa não existe retorna -1
                if($contPessoa <= 0){
                    echo '-1';
                    break;
                }
                //valida se a pessoa da inscrição existe
                $participante->consultar('select idParticipante from participante, pessoa where cpf = "' . $_GET['cpf'] . '" and  idUsuario=fkUsuario');
                $rs = $participante->Result;
                    while ($respParticipante = mysqli_fetch_array($rs)) {
                        $idPart = $respParticipante['idParticipante'];
                }
                $_GET['fkParticipante'] = $idPart;
                $depoimento->incluir($_GET['mensagem'], $_GET['cpf'], $_GET['fkParticipante'] );

                //ENVIO DE E-MAIL
                //require_once('email/emailDepoimento.php');
                echo '1';


            }
            break;

        case 'consultar':
            global $linha;
            global $rsDepoimento;
            $depoimento = new Depoimento();
            $depoimento->consultar("SELECT depoimento.*, pessoa.nome FROM oep.depoimento, oep.participante, oep.pessoa where depoimento.fkParticipante = participante.idParticipante and participante.fkUsuario = pessoa.idUsuario ;");
            $linha = $depoimento->Linha;
            $rsDepoimento = $depoimento->Result;
            if (isset($_GET['editar']) == "aceito") {
                $depoimento->alterar($_POST['status'], $_GET['idDepoimento']);
                echo '<script>alert("Depoimento aceito com sucesso !");</script>';
                echo '<script>window.location="lista_depoimento.php?pg=depoimento";</script>';
            }
            if (isset($_GET['ok']) == "excluir") {
                $depoimento->excluir($_GET['idDepoimento']);
                echo '<script>alert("Excluido com sucesso !");</script>';
                echo '<script>window.location="lista_depoimento.php?pg=depoimento";</script>';
            }
            break;


        case 'consultarEnviado':
            global $linha;
            global $rsDepoimento;
            $depoimento = new Depoimento();
            $depoimento->consultar("SELECT depoimento.*, pessoa.nome FROM oep.depoimento, oep.participante, oep.pessoa where depoimento.fkParticipante = participante.idParticipante and participante.fkUsuario = pessoa.idUsuario AND status = 'Enviado' ;");
            $linha = $depoimento->Linha;
            $rsDepoimento = $depoimento->Result;

            break;

        case 'consultarAceito':
            global $linha;
            global $rsDepoimento;
            $depoimento = new Depoimento();
            $depoimento->consultar("SELECT depoimento.*, pessoa.nome FROM oep.depoimento, oep.participante, oep.pessoa where depoimento.fkParticipante = participante.idParticipante and participante.fkUsuario = pessoa.idUsuario AND status = 'Aceito' ;");
            $linha = $depoimento->Linha;
            $rsDepoimento = $depoimento->Result;

            break;
    }
}
