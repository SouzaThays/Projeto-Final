<?php include('menu_login.php'); ?>
<?PHP
session_start();
session_destroy(); # Destruir todas as sessões do navegador
echo '<script>window.location="login.php";</script>';
?>
<div class="msg1 padding20">Logout efetuado com sucesso!<br><br>Redirecionando para a página inicial...</div>

<script type="text/javascript">
    
setTimeout("window.location='index.php?pg=inicio';",4000);
</script>
