<?php
require_once('Conexao.php');
require_once('Donativo.php');

class Doacao
{
    private $idDoacao;
    private $data;
    private $pontuacao;
    private $fkDonativo;
    private $fkEscola;


    public function incluir($fkEscola, $fkDonativo, $ListaidDonat, $ListaQtd) {


        $Acesso = new Acesso();
        $Acesso->Conexao();

        $iDonat = 0;

        foreach ($ListaidDonat as &  $valuDonat) {

            $vDonat = $valuDonat;
            $iQtd = 0;
            foreach ($ListaQtd as & $valueQtd) {

                if($iQtd == $iDonat){

                   $vQtd = $valueQtd;

/*-------------------------calcula pontuacao-------------------------------------------------*/
                   $donativo = new Donativo();
                   $vpontuacao = 0;
                   $donativo->consultar('select pontuacao from oep.donativo
                       where idDonativo = "' . $vDonat . '"');
                   $rsDonat = $donativo->Result;

                   while ($respPontuacao = mysqli_fetch_array($rsDonat)) {
                       $vpontuacao = $respPontuacao['pontuacao'];
                   }

                   $totalPontuacao = $vpontuacao * $vQtd;
/*-------------------------calcula pontuacao-------------------------------------------------*/

                   $insert = 'insert into doacao(data, pontuacao, fkDonativo, fkEscola, quantidade)
                   values(NOW(), "' . $totalPontuacao . '" , "' . $vDonat . '", "' . $fkEscola . '","' . $vQtd . '")';

                $Acesso->Query($insert);
               }
                $iQtd ++;
            }
            $iDonat++;
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

    public function excluir($idDoacao) {

        $delete = 'delete from doacaoo where idDoacao="' . $idDoacao . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($delete);
    }

    // ----- FUNÇÃO DE EDIÇÃO DE DADOS ----- //

    public function alterar($data, $pontuacao, $idDoacao) {

        $update = 'update doacao set data="' . $data .'", pontuacao="' . $pontuacao  . '"  where idDoacao="' . $idDoacao . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        $this->Linha = mysqli_num_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }
}