<?php

require_once('Conexao.php');

class Alternativa
{
    private $resposta;

    public function incluirAlternativa($lstalternativa) {
        $Acesso = new Acesso();
        $Acesso->Conexao();
        foreach ($lstalternativa as &  $valueAlternativa) {
            $vAlternativa = $valueAlternativa;
            $insert = 'insert into alternativas(descricaoAlt) values("' . $vAlternativa . '")';
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

    public function excluir($idAlternativa) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $delete = 'delete from alternativas  where idAlternativas ="' . $idAlternativa . '"';

        $Acesso->Query($delete);

    }

}