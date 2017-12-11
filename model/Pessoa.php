<?php
require_once('Conexao.php');
/**
 * Created by PhpStorm.
 * User: thays
 * Date: 12/08/2017
 * Time: 21:44
 */

class Pessoa
{
    private $nome;
    private $dataNasc;
    private $cpf;
    private $rg;
    private $orgaoExpedidor;
    private $telefoneFixo;
    private $celular;
    private $sexo;
    private $planoSaude;
    private $alergia;
    private $tipoSanguineo;
    private $endereco;


    private $matricula;
    private $matriculaC;
    private $turno;
    private $periodo;

    private $fkCurso;

    private $instituicao;

    private $cargo;





    public function incluirPessoa($nome, $email, $dataNascimento, $cpf, $rg, $orgaoExpedidor, $telefoneFixo, $telefoneCelular,
        $sexo, $planoSaude, $alergia, $tipoSanguineo, $endereco) {


        $insert = 'insert into pessoa(nome, email, dataNascimento, cpf, rg, orgaoExpedidor, telefoneFixo, telefoneCelular, sexo,
            planoSaude, alergia, tipoSanguineo, endereco) values("' . $nome . '", "' .  $email . '", "' .  $dataNascimento . '", "' .
            $cpf . '", "' .  $rg . '", "' .  $orgaoExpedidor . '", "' .  $telefoneFixo . '", "' .  $telefoneCelular . '", "' .  $sexo . '", "' .
            $planoSaude . '", "' .  $alergia . '", "' .  $tipoSanguineo . '", "' .  $endereco . '")';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($insert);
    }


    public function incluirParticipante($matricula,$fkCurso, $turno, $periodo, $cpf, $matriculaC, $cargo, $instituicao ){

        if(empty($matriculaC) && empty($instituicao)){

            // $intMatricula = intval($variavel);

            $insert = 'insert into estudante(matricula, fkUsuario, fkCurso, periodo, turno )
            value ("' . $matricula . '","' .  $cpf .  '","' .  $fkCurso . '","' .  $periodo . '","' .  $turno . '")';

            $Acesso = new Acesso();

            $Acesso->Conexao();

            $Acesso->Query($insert);

        }
        if(empty($matricula) && empty($instituicao)){

            $insert = 'insert into colaborador (matricula, cargo, fkUsuario)
            value ("' . $matriculaC . '", "' .  $cargo . '" ,"' .  $cpf .  '")';

            $Acesso = new Acesso();

            $Acesso->Conexao();

            $Acesso->Query($insert);

        }
        if(empty($matricula) && empty($matriculaC) ){

            $insert = 'insert into comunidadeexterna (instituicao, fkUsuario)
            value ("' .  $instituicao . '","' .  $cpf .  '")';

            $Acesso = new Acesso();

            $Acesso->Conexao();

            $Acesso->Query($insert);

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

    public function excluir($idUsuario) {

        $delete = 'delete from pessoa where idUsuario="' . $idUsuario . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($delete);
    }

    // ----- FUNÇÃO DE EDIÇÃO DE DADOS ----- //

    public function alterar($nome, $email, $dataNascimento, $cpf, $rg, $orgaoExpedidor, $telefoneFixo, $telefoneCelular, $sexo, $planoSaude, $alergia, $tipoSanguineo, $endereco, $idUsuario) {

        $update = 'update pessoa set nome="' . $nome  . '", email="' . $email . '", dataNascimento="' . $dataNascimento .'", cpf="' . $cpf .'", rg="' . $rg .'", orgaoExpedidor="' . $orgaoExpedidor .'", telefoneFixo="' . $telefoneFixo .'", telefoneCelular="' . $telefoneCelular .'", sexo="' . $sexo .'", planoSaude="' . $planoSaude .'", alergia="' . $alergia .'", tipoSanguineo="' . $tipoSanguineo .'", endereco="' . $endereco  . '"  where idUsuario="' . $idUsuario . '"';

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        $this->Linha = mysqli_num_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

}