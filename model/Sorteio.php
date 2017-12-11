<?php

require_once('Conexao.php');

class Sorteio {


    private $dtInicio;
    Private $dtFim;
    Private $premio;
    Private $regra;


    public function incluir($dtInicio, $dtFim, $premio, $regra, $idProj) {

        $insert = 'insert into sorteio(dataInicio, dataFim, premio, regra, fkProjeto)
                values("' . $dtInicio . '", "' . $dtFim . '", "'. $premio . '","' . $regra . '" ,"' . $idProj . '")';

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