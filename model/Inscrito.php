<?php
require_once('Conexao.php');

class Inscrito
{

    private $idInscrito;
    Private $status;
    Private $dataInscricao;
    Private $statusTaxa;
    Private $fkProjeto;
    Private $fkParticipante;



    public function incluir($idProjeto,$cpf) {

        $status = "Ativo";
        $statusTaxa = "Aberto";


        $data_atual = date("Y-m-d");

        $insert = 'insert into inscricao(status, dataInscricao, statusTaxa, fkProjeto, fkParticipante)
          values("' . $status . '" ,"' . $data_atual . '" ,"' . $statusTaxa . '" , "' . $idProjeto . '" ,
            (select idParticipante from participante, pessoa
        where cpf = "' .  $cpf .  '" and idUsuario = fkusuario and  DataInicio <= NOW() AND DataFim is null))';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($insert);
    }

    // ----- FUNÇÃO DE CONSULTA DE DADOS ----- //

    public function consultar($sql) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysqli_affected_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

    public function cancelar($idEx) {

        $update = 'update inscricao set status= "Cancelado", dataFim= NOW()
        where idInscrito="' . $idEx . '" ';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        $this->Linha = mysqli_num_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }




}

