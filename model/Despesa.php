<?php
require_once('Conexao.php');


class Despesa
{
    private $idDespesas;
    private $mnDespesas;
    private $valor;


    public function incluir($lstDespesas, $lstvalor,$nome, $dataInicio, $dataFim, $fkprograma, $fkPlanejamento) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $iDes = 0;

        foreach ($lstDespesas as &  $valueDes) {

            $vDespesa = $valueDes;
            $iVal = 0;
            foreach ($lstvalor as & $valueVal) {

                if($iVal == $iDes){

                   $vVal = $valueVal;
                   $insert = ' insert into despesas( mnDespesas, valor, idProjeto)
                    values("' . $vDespesa . '", "' . $vVal . '" ,
                    (select idProjeto from projeto where nome = "' .  $nome .  '" and dataInicio = "' .  $dataInicio .  '"
                       and dataFim = "' .  $dataFim .  '" and fkprograma = "' .  $fkprograma .  '" and
                        fkPlanejamento = "' .  $fkPlanejamento .  '"))';
                   $Acesso->Query($insert);
               }
                $iVal ++;
            }
            $iDes++;
        }
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

    public function excluir($lstIdEx) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        foreach ($lstIdEx as &  $valueId) {

            $vid = $valueId;
            $delete = 'delete from despesas where idDespesas="' . $vid . '"';
            $Acesso->Query($delete);
        }

    }

    // ----- FUNÇÃO DE EDIÇÃO DE DADOS ----- //

    public function alterar($lstDespesas, $lstvalor,$idPlanejamento,$idProjeto,$lstId) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $insert = "";
        $iDes = 0;
        $iid = 0;


        foreach ($lstDespesas as &  $valueDes) {

            $vDespesa = $valueDes;
            $iVal = 0;
            foreach ($lstvalor as & $valueVal) {

                if($iVal == $iDes){

                    $vVal = $valueVal;

                    $iid = 0;
                    foreach ($lstId as & $valueId) {

                        if($iDes == $iid ){

                            $vId = $valueId;

                            if(empty($vId)){
                                //se está vazio a despesa nao existe, faz INSERT

                                $insert = ' insert into despesas( mnDespesas, valor, idProjeto)
                                values("' . $vDespesa . '", "' . $vVal . '", "' . $idProjeto . '")';
                                $Acesso->Query($insert);


                            }else{
                                //se tem id a despesa existe, faz UPDATE

                                $update = 'update despesas set mnDespesas="' . $vDespesa .'", valor="' . $vVal  . '"
                                    where idDespesas ="' . $vId . '" and idProjeto ="' . $idProjeto . '" ';

                                $Acesso->Query($update);
                                $this->Linha = mysqli_num_rows($Acesso->result);
                                $this->Result = $Acesso->result;

                            }
                        }
                        $iid++;
                    }
                }
                $iVal ++;
            }
            $iDes++;
        }

    }
}