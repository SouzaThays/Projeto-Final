<?php

require_once('Conexao.php');



class Resposta
{


    private $resposta;

    public function incluirRespostaEnq($fkProjeto, $fkInscrito, $fkEnquete, $ListaidPerg, $ListaIdResposta) {
        $Acesso = new Acesso();
        $Acesso->Conexao();
        $iPerg = 0;
        foreach ($ListaidPerg as &  $valuePergunta) {
            $vPerg = $valuePergunta;

            $iResp = 0;
            foreach ($ListaIdResposta as &  $valueResposta) {
                if($iResp == $iPerg){
                $vResp = $valueResposta;

                    $iEnq = 0;
                    foreach ($fkEnquete as &  $valueEnquete) {
                        if($iEnq == $iResp){
                            $vEnq = $valueEnquete;
                            $insert = 'insert into resposta(fkInscrito,  fkEnquete, fkProjeto, fkPerguntas, fkAlternativas)
                       values("' . $fkInscrito . '" , "' . $vEnq . '", "' . $fkProjeto . '","' . $vPerg . '","' . $vResp . '")';

                            $Acesso->Query($insert);
                        }
                        $iEnq ++;
                    }
                }
                $iResp ++;
            }
            $iPerg ++;

        }

   }

    public function consultar($sql) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysqli_affected_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }


}

