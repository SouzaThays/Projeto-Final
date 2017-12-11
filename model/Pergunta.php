<?php

require_once('Conexao.php');
class Pergunta
{
    private $pergunta;

    public function incluirPergunta($lstpergunta) {
        $Acesso = new Acesso();
        $Acesso->Conexao();
        foreach ($lstpergunta as &  $valuePergunta) {
            $vPergunta = $valuePergunta;
            $insert = 'insert into perguntas(descricao) values("' . $vPergunta . '")';
            $Acesso->Query($insert);
        }
    }


    public function consultar($sql) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysqli_affected_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }


    public function excluir($idPergunta) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $delete = 'delete from perguntas  where idPerguntas ="' . $idPergunta . '"';

        $Acesso->Query($delete);

    }


}