<?php

require_once('Conexao.php');
class Faq
{
    private $pergunta;

    public function incluir($lstpergunta, $lstresposta, $pastoralista) {
        $Acesso = new Acesso();
        $Acesso->Conexao();
        $iPerg = 0;
        foreach ($lstpergunta as &  $valuePergunta) {
            $iResp = 0;
            $vPergunta = $valuePergunta;
            foreach ($lstresposta as &  $valueResposta) {

                if($iPerg == $iResp){

                $vResposta = $valueResposta;
                $insert = 'insert into faq(pergunta, resposta, fkPastoralista) values("' . $vPergunta . '", "' . $vResposta . '", "' . $pastoralista . '")';
                $Acesso->Query($insert);
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


    public function excluir($idPergunta) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $delete = 'delete from faq where idFAQ ="' . $idPergunta . '"';

        $Acesso->Query($delete);

    }



    public function alterar( $pergunta, $resposta, $idFaq) {

        $update = 'update faq set pergunta="' . $pergunta . '", resposta="' .$resposta .  '" where idFaq="' . $idFaq . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        $this->Linha = mysqli_num_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }


}