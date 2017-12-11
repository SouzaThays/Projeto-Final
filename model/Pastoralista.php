<?php

require_once('Conexao.php');

class Pastoralista
{
    private $matricula;

    public function incluir( $login, $matricula, $fkUsuario) {

        $insert = 'insert into pastoralista (matricula, fkUsuario, login)
          values("' . $matricula . '", "' . $fkUsuario . '", "' . $login . '")';

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



    public function alterar( $senha, $status, $login) {

        $update = 'update login set senha="' . $senha . '", status="' .$status .  '" where login="' . $login . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        $this->Linha = mysqli_num_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

}