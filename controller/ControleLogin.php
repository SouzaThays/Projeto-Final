<?php

require_once("model/Login.php");

function Login($Processo) {

    switch ($Processo) {

        case 'login':

            global $rs;
            global $rsDesc;

            $login = new Login();

            if (isset($_POST['ok']) == 'true') {
                $logar = $_POST['login'];
                $senhaInformada = $_POST['senha'];

                //$Senha = base64_decode($senha);

                $login->consultar('select * from oep.login');
                $rsDesc = $login->Result;
                while ($respSenha = mysqli_fetch_array($rsDesc)) {
                    $senhaCod = $respSenha['senha'];
                    $Senha = base64_decode($senhaCod);


                    if($Senha == $senhaInformada){
                        $login->consultar('select * from oep.login where login LIKE "' . $logar . '" and senha LIKE "' . $senhaCod . '" ');
                        $rs = $login->Result;


                    }
                }
                $cont = $rs->num_rows;
                // $s = $status;
                if($cont == '')
                        {
                            echo '<script>alert("Login incorreto !");</script>';

                        }
                        else
                        {
                                while($dados=mysqli_fetch_assoc($rs))
                                {
                                    $status = $dados['status'];

                                    if($status == "Desativado"){
                                        echo '<script>alert("Sem acesso!!!!!");</script>';


                                    }else{
                                        session_start();
                                        $_SESSION['login'] = $dados['login'];
                                        $_SESSION['status'] = $dados['status'];
                                        header("Location: index_adm.php?pg=inicio");
                                    }
                                }

                        }



            }

            break;



        case 'consultarRelatorio':

            global $rs;

            $login = new Login();

            if (isset($_GET['relat']) == 'acesso') {
                $login->consultar('select login acesso, status from login');
            }


            $rs = $login->Result;

            break;
    }
}
