<?php include('menu_login.php'); ?>
<?php

      require_once('controller/ControleLogin.php');
      Login('login');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />

    <?php include('default.php'); ?>
</head>
<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">
                Partal<b>OEP</b>
            </a>
            <small>Observatório de Evangelização e Pastoral</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Acesso</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="login" placeholder="Usuário" required autofocus />
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="senha" placeholder="Senha" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                           
                            <input type="submit" name="button" id="button" value="Acessar" class="btn bg-puc waves-effect" />
                            <input type="hidden" name="ok" id="ok" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
