<?php

require_once("model/Pastoralista.php");
require_once("model/Pessoa.php");
require_once("model/Login.php");

function Pastoralista($Processo) {

    switch ($Processo) {

        case 'incluir':

            global $rs;
            global $rsUsu;
            $pastoralista = new Pastoralista();
            $usuario = new Pessoa();

            $usuario->consultar('select idUsuario from pessoa where cpf = "' . $_POST['cpf'] . '" ');
            $rsUsu = $usuario->Result;

            while ($respParticipante = mysqli_fetch_array($rsUsu)) {
                $idPart = $respParticipante['idUsuario'];
            }

            global $rs;
            $login = new Login();
            $codificadaSenha =   base64_encode($_POST['senha']);
            $login->consultar('select login from login where login = "' . $_POST['login'] . '" ');
            $rs = $login->Result;

            while ($respLogin = mysqli_fetch_array($rs)) {
                $idPart = $respParticipante['login'];
            }



            if (isset($_POST['ok']) == 'true') {

                $cont = $rs->num_rows;
                if($cont > 0){
                    echo '<script>alert("Login ja existe no sistema !");</script>';
                    break;
                }

                $login->incluir($_POST['login'], $codificadaSenha, $_POST['status']);
                $pastoralista->incluir($_POST['login'], $_POST['matricula'], $idPart);
                echo '<script>alert("Cadastrado com sucesso !");</script>';
                echo '<script>window.location="lista_pastoralistas.php?pg=LstPast";</script>';
            }

            break;

        case 'consultar':

            global $rs;

            $pastoralista = new Pastoralista();

            $pastoralista->consultar("select * from pastoralista, login where pastoralista.login LIKE login.login");
            $rs = $pastoralista->Result;


            break;


        case 'editar':

            global $rs;

            $pastoralista = new Pastoralista();
            $login = $_GET['login'];



            $pastoralista->consultar('select * from login, pastoralista where pastoralista.login LIKE login.login and login.login LIKE "' . $login . '" ' );
            $rs = $pastoralista->Result;

            if (isset($_POST['ok']) == "true") {
                $pastoralista->alterar($_POST['senha'], $_POST['status'], $_GET['login']);
                echo '<script>alert("Alterado com sucesso !");</script>';
                echo '<script>window.location="lista_pastoralistas.php";</script>';
            }

            break;
    }
}
