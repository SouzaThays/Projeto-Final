<?php
require_once('Conexao.php');


class Curso
{

    private $idCurso;
    private $nome;
    private $fkEscola;


    public function consultar($sql) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysqli_affected_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

}