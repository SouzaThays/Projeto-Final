
<div class="user-info">
    <div class="info-container">
        
    </div>
</div>

<?php
$estilo = "class=\"active\"";

if ($_GET["pg"] == "inicio")
    $estilo = "class=\"active\"";
elseif ($_GET["pg"] == "inscricao"  ){
    $estilo2 = "class=\"active\"";
    $estilo = "";
}
elseif ($_GET["pg"] == "NovoParticipante"){
    $estilo3 = "class=\"active\"";
    $estilo = "";
}
elseif ($_GET["pg"] == "certificado"){
    $estilo4 = "class=\"active\"";
    $estilo = "";
}
elseif ($_GET["pg"] == "depoimento"){
    $estilo5 = "class=\"active\"";
    $estilo = "";
}
elseif ($_GET["pg"] == "enquete"){
    $estilo6 = "class=\"active\"";
    $estilo = "";
}
elseif ($_GET["pg"] == "faq"){
    $estilo7 = "class=\"active\"";
    $estilo = "";
}
elseif ($_GET["pg"] == "contato"){
    $estilo8 = "class=\"active\"";
    $estilo = "";
}
elseif ($_GET["pg"] == "enquete1"){
    $estilo11 = "class=\"active\"";
    $estilo = "";
}

elseif ($_GET["pg"] == "faq1"){
    $estilo12 = "class=\"active\"";
    $estilo = "";
}

elseif ($_GET["pg"] == "cancel"){
    $estilo13 = "class=\"active\"";
    $estilo = "";
}

?>

<div class="menu">
    <ul class="list">
        <li class="header">MENU DE NAVEGAÇÃO</li>
        <li <?php echo $estilo; ?>>
            <a href="index.php?pg=inicio">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>


        <li <?php echo $estilo2; ?>>
            <a href="inscricao.php?pg=inscricao">
                <i class="material-icons">local_activity</i>
                <span>Projeto</span>

            </a>
        </li>

        <li <?php echo $estilo3; ?>>
            <a href="novo_participante.php?pg=NovoParticipante">
                <i class="material-icons">people</i>
                <span>Cadastro</span>

            </a>
        </li>
    

        <li <?php echo $estilo5; ?>>
            <a href="enviar_depoimento.php?pg=depoimento">
                <i class="material-icons">comment</i>
                <span>Depoimento</span>
            </a>
        </li>

        <li <?php echo $estilo11; ?>>
            <a href="entrar_enquete.php?pg=enquete1">
                <i class="material-icons">toc</i>
                <span>Enquete</span>
            </a>
        </li>

        <li <?php echo $estilo12; ?>>
            <a href="visualizar_faq.php?pg=faq1">
                <i class="material-icons">help</i>
                <span>FAQ</span>
            </a>
        </li>
    
        <li <?php echo $estilo13; ?>>
            <a href="cancelar.php?pg=cancel">
                <i class="material-icons">indeterminate_check_box</i>
                <span>Cancelar Inscrição</span>
            </a>
        </li>


    </ul>
</div>