<?php

require_once('Conexao.php');

class Projeto {


    private $idProjeto;
    Private $nome;
    Private $dataInicio;
    Private $dataFim;
    Private $informacao;
    Private $assessoria;
    Private $responsavel;
    Private $numVagas;
    Private $valorTaxa;
    Private $local;
    Private $fkprograma;
    Private $fkPlanejamento;
    private $certifHC;
    private $certifPC;


    public function incluir($nome, $dataInicio, $dataFim, $informacao, $assessoria,
                            $responsavel, $numVagas, $valorTaxa, $certifHC, $certifPC, $local, $fkprograma, $fkPlanejamento, $tipo) {


        $Acesso = new Acesso();
        $Acesso->Conexao();

        $insert = 'insert into projeto(nome, dataInicio, dataFim, informacao, assessoria, responsavel, numVagas, valorTaxa,
            certifPC, certifHC, local, fkprograma, fkPlanejamento,qtdVagas,tipoVaga ) values("' . $nome . '", "' . $dataInicio . '", "'. $dataFim . '",
            "' . $informacao . '","' . $assessoria . '", "' . $responsavel . '", "'   . $numVagas . '", "'. $valorTaxa . '", "' . $certifPC . '",
            "' . $certifHC . '", "'  . $local . '", "' . $fkprograma . '", "' . $fkPlanejamento . '","' . $numVagas . '","' . $tipo . '")';

        // a quantidade de vagas começa com o nuemro total de vagas

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

    // ----- FUNÇÃO DE EXCLUSÃO DE DADOS ----- //

    public function excluir($idProjeto) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $deleteDes = 'delete from despesas where idProjeto ="' . $idProjeto . '"';


        $delete = 'delete from projeto where idProjeto = "' . $idProjeto . '" ';

        $Acesso->Query($deleteDes);
        $Acesso->Query($delete);

    }

    // ----- FUNÇÃO DE EDIÇÃO DE DADOS ----- //

    public function alterar($nome, $dataInicio, $dataFim, $informacao, $assessoria,
                            $responsavel, $numVagas, $valorTaxa, $certifHC, $certifPC, $local, $fkprograma, $fkPlanejamento,$idProjeto,
                            $tipoVaga) {

        $update = 'update projeto set nome="' . $nome . '", dataInicio="' .$dataInicio . '", dataFim="' . $dataFim . '", informacao="' .
            $informacao . '", assessoria="' . $assessoria . '", responsavel="' . $responsavel . '", numVagas="' . $numVagas .'",
            valorTaxa="' . $valorTaxa . '", local ="' . $local .'", certifPC ="' . $certifPC .'",
            certifHC ="' . $certifHC . '",
             tipoVaga="' . $tipoVaga .'"
        where idProjeto="' . $idProjeto . '" and
        fkPlanejamento="' . $fkPlanejamento . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        $this->Linha = mysqli_num_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

    public function atualizarVaga($idProjeto) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $projeto = new Projeto();

        $vnumVagas = 0;
        $vQtdVagas = 0;

        $projeto->consultar('select numVagas, qtdVagas from projeto where idProjeto="' . $idProjeto . '" ');
        $rsqtdVagas = $projeto->Result;

        while ($respVagas = mysqli_fetch_array($rsqtdVagas)) {
            $vQtdVagas = $respVagas['qtdVagas'];
            $vnumVagas = $respVagas['numVagas'];
        }
        //se o numVagas é maior que zero existe limite de vagas.
        if($vnumVagas > 0){

            $vQtdVagas--;
            $update = 'update projeto set  qtdVagas="' . $vQtdVagas .'" where idProjeto="' . $idProjeto . '" ';
            $Acesso->Query($update);
        }



    }


}
