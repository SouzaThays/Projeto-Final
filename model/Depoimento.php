<?php
require_once('Conexao.php');

class Depoimento
{

    private $iddepoimento;
    Private $mensagem;
    Private $dataEnvio;
    Private $status;
    Private $fkParticipante;



    public function incluir($mensagem, $cpf, $fkParticipante) {


        $dataEnvio = date("Y-m-d");
        $status = "Enviado";

        $insert = 'insert into depoimento(mensagem, dataEnvio, status, fkParticipante)
          values("' . $mensagem . '" ,"' . $dataEnvio . '" ,"' . $status . '" , "' . $fkParticipante . '")';

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

    public function alterar( $status, $idDepoimento) {

        $status='Aceito';

        $update = 'update oep.depoimento set status="' . $status . '" where iddepoimento="' . $idDepoimento . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        $this->Linha = mysqli_num_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

    public function excluir($idDepoimento) {

        $delete = 'delete from depoimento where iddepoimento="' . $idDepoimento . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($delete);
    }






}

