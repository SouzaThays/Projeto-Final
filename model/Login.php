<?php

require_once('Conexao.php');

class Login
{
    private $login;
    private $senha;
    private $status;

    public function efetuarLogin($sql) {


        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysqli_affected_rows($Acesso->result);

        $this->Result = $Acesso->result;

        $rs = $Acesso->Result;

        $cont = $rs->num_rows;

        echo $cont;



    }


    public function incluir($login, $senha , $status) {


        $insert = 'insert into login (login, senha, status)
          values("' . $login . '", "' . $senha . '", "' . $status . '")';

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

    public function excluir($idAlternativa) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $delete = 'delete from alternativas  where idAlternativas ="' . $idAlternativa . '"';

        $Acesso->Query($delete);

    }

}