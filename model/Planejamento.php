<?php
require_once('Conexao.php');

class Planejamento
{
    private $idPlanejamento;
    private $ano;
    private $descricao;

    public function consultar($sql) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysqli_affected_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

    public function incluir($descricao, $ano, $dataFim, $dataInicio) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $insert = 'insert into planejamento(ano, descricao, dataInicio, dataFim) 
            values("' . $ano . '", "' . $descricao . '", "'. $dataFim . '", "' . $dataInicio . '")';

        $Acesso->Query($insert);
    }

}