<?php
require_once('Conexao.php');
/**
 * Created by PhpStorm.
 * User: thays
 * Date: 12/08/2017
 * Time: 21:44
 */

class Participante
{
    private $idParticipante;
    private $DataInicio;
    private $DataFim;
    private $fkUsuario;


    public function incluir($cpf) {

        $data_atual = date("Y-m-d");

        $insert = 'insert into participante (DataInicio, fkUsuario)
          values("' . $data_atual . '", (select idUsuario from pessoa where cpf = "' .  $cpf .  '") )';

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


    public function excluir($idUsuario) {

        $delete = 'delete from pessoa where idUsuario="' . $idUsuario . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($delete);
    }


    public function consultarId($cpf) {




       // $select = 'select idParticipante from participante, pessoa where cpf = "' . $cpf . '" and DataInicio <= NOW() AND DataFim is null';
        //$select = 'select * from participante ';







    }

}