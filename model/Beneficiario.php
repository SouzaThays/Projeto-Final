<?php

require_once('Conexao.php');

class Beneficiario {


    private $idBeneficiario;
    Private $nome;
    Private $telefone;
    Private $nomeResponsavel;
    Private $endereco;


    public function incluirBeneficiario($nome, $telefone, $nomeResponsavel, $endereco) {

        $insert = 'insert into beneficiario(nome, telefone, nomeResponsavel, endereco) 
                values("' . $nome . '", "' . $telefone . '", "'. $nomeResponsavel . '","' . $endereco . '")';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($insert);
    }


    public function consultar($sql) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysqli_affected_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

 

    public function excluir($idBeneficiario) {

        $delete = 'delete from beneficiario where idBeneficiario="' . $idBeneficiario . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($delete);
    }


    public function alterar( $nome, $telefone, $nomeResponsavel, $endereco, $idBeneficiario) {

        $update = 'update beneficiario set nome="' . $nome . '", telefone="' .$telefone . '", nomeResponsavel="' . $nomeResponsavel . '", endereco="' . $endereco . '" where idBeneficiario="' . $idBeneficiario . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        $this->Linha = mysqli_num_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

}