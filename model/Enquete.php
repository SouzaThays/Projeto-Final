<?php

require_once('Conexao.php');

class Enquete
{
    private $idPergunta;
    private $idResposta;

    public function alterar($dataInicio, $dataFim, $idProjeto) {


        $update = 'update enquete set inicio="' . $dataInicio . '", fim="' .$dataFim . '"
        where fkProjeto="' . $idProjeto . '" ';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        $this->Linha = mysqli_num_rows($Acesso->result);

        $this->Result = $Acesso->result;


    }

    public function incluirEnquete($pergunta, $lstalternativa, $fkProjeto, $inicio, $fim) {
        $Acesso = new Acesso();
        $Acesso->Conexao();


        $contagem = array_count_values($lstalternativa);
        foreach($contagem AS $numero => $vezes) {
            if($vezes % 2 == 0) {
            }else{
                $insert = 'insert into enquete(fkAlternativas, fkPerguntas, fkProjeto, inicio, fim) values("' . $numero . '" , "' . $pergunta . '", "' . $fkProjeto . '" , "' . $inicio . '" , "' . $fim . '")';
                    $Acesso->Query($insert);

            }
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

        $delete = 'delete from enquete  where idEnquete ="' . $idAlternativa . '"';

        $Acesso->Query($delete);

    }

}