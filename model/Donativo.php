<?php
require_once('Conexao.php');

class Donativo
{
    private $idDonativo;
    private $nome;
    private $pontuacao;

    public function incluir($nome, $pontuacao) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $insert = 'insert into donativo (nome, pontuacao)
          values("' . $nome . '" ,"' . $pontuacao . '")';

        $Acesso->Query($insert);
    }

    public function consultar($sql) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysqli_affected_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }


}