



<div class="user-info">
    <div class="info-container">
        <!--<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
        <div class="email">john.doe@example.com</div>-->

    </div>

</div>

<?php
$estilo = "";

if ($_GET["pg"] == "inicio")
    $estilo = "class=\"active\"";


elseif ($_GET["pg"] == "NovoProjetos" || $_GET["pg"] == "listaProjetos" || $_GET["pg"] == "novoPlanejamento" ){
    $estilo2 = "class=\"active\"";

    if ($_GET["pg"] == "novoPlanejamento"){
        $estilo99 = "class=\"active\"";
    }

    if ($_GET["pg"] == "NovoProjetos"){
        $estilo3 = "class=\"active\"";

    }
    elseif ($_GET["pg"] == "listaProjetos")
        $estilo4 = "class=\"active\"";

}
elseif ($_GET["pg"] == "participante")
    $estilo5 = "class=\"active\"";
elseif ($_GET["pg"] == "email")
    $estilo7 = "class=\"active\"";
elseif ($_GET["pg"] == "certificado")
    $estilo8 = "class=\"active\"";
elseif ($_GET["pg"] == "cracha")
    $estilo9 = "class=\"active\"";


elseif ($_GET["pg"] == "listaDoacao" || $_GET["pg"] == "novoDacao" || $_GET["pg"] == "ranking" || $_GET["pg"] == "beneficiario"
    ||  $_GET["pg"] == "listaBen" ||  $_GET["pg"] == "novoBen" ||  $_GET["pg"] == "donativo" ||  $_GET["pg"] == "lstdonativo" ){
    $estilo11 = "class=\"active\"";
    if ($_GET["pg"] == "listaDoacao")
        $estilo12 = "class=\"active\"";

    elseif ($_GET["pg"] == "novoDacao")
        $estilo13 = "class=\"active\"";
    elseif ($_GET["pg"] == "ranking")
        $estilo14 = "class=\"active\"";
    elseif ($_GET["pg"] == "beneficiario")
        $estilo15 = "class=\"active\"";
    elseif ($_GET["pg"] == "listaBen")
        $estilo21 = "class=\"active\"";
    elseif ($_GET["pg"] == "novoBen")
        $estilo22 = "class=\"active\"";

    elseif ($_GET["pg"] == "donativo")
        $estilo23 = "class=\"active\"";
    elseif ($_GET["pg"] == "lstdonativo")
        $estilo24 = "class=\"active\"";



}

elseif ($_GET["pg"] == "participante")
    $estilo16 = "class=\"active\"";


elseif ($_GET["pg"] == "depoimento")
    $estilo17 = "class=\"active\"";


elseif ($_GET["pg"] == "depoimento")
    $estilo18 = "class=\"active\"";


elseif ($_GET["pg"] == "novaPergunta" || $_GET["pg"] == "novaResposta" || $_GET["pg"] == "listaPergunta" || $_GET["pg"] == "listaResposta"|| $_GET["pg"] == "projetoEncerrado" || $_GET["pg"] == "listainscritoencerrados"){
    $estilo19 = "class=\"active\"";
    if ($_GET["pg"] == "novaPergunta")
        $estilo21 = "class=\"active\"";
    elseif ($_GET["pg"] == "novaResposta")
        $estilo22 = "class=\"active\"";
    elseif ($_GET["pg"] == "listaPergunta")
        $estilo23 = "class=\"active\"";
    elseif ($_GET["pg"] == "listaResposta")
        $estilo24 = "class=\"active\"";
    elseif ($_GET["pg"] == "projetoEncerrado")
        $estilo25 = "class=\"active\"";
    elseif ($_GET["pg"] == "listainscritoencerrados")
        $estilo25 = "class=\"active\"";


}

elseif ($_GET["pg"] == "faq" || $_GET["pg"] == "listaFaq" || $_GET["pg"] == "lista"){
    $estilo40 = "class=\"active\"";
    if ($_GET["pg"] == "faq")
        $estilo30 = "class=\"active\"";
    elseif ($_GET["pg"] == "listaFaq")
        $estilo31 = "class=\"active\"";
    elseif ($_GET["pg"] == "lista")
        $estilo32 = "class=\"active\"";


}


elseif ($_GET["pg"] == "relatorio")
    $estilo33 = "class=\"active\"";

elseif ($_GET["pg"] == "novoPast" || $_GET["pg"] == "LstPast"){
    $estilo99 = "class=\"active\"";
    if ($_GET["pg"] == "novoPast")
        $estilo999 = "class=\"active\"";
    elseif ($_GET["pg"] == "LstPast")
        $estilo9999 = "class=\"active\"";
}

    elseif ($_GET["pg"] == "pessoa")
        $estilo35 = "class=\"active\"";




    elseif ($_GET["pg"] == "sorteio" || $_GET["pg"] == "LstSort"){
        $estilo18 = "class=\"active\"";
        if ($_GET["pg"] == "sorteio")
            $estilo70 = "class=\"active\"";
        elseif ($_GET["pg"] == "LstSort")
            $estilo80 = "class=\"active\"";
    }



?>




<div class="menu">
    <ul class="list">
        <li class="header">MENU DE NAVEGAÇÃO</li>

		
        <?php $adm = $_SESSION['status'];?>


        <li <?php echo $estilo; ?>>
            <a href="index_adm.php?pg=inicio">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>
        <li <?php echo $estilo2; ?>>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">local_activity</i>
                <span>Projetos</span>
            </a>
            <ul class="ml-menu">

                <li <?php echo $estilo99; ?>>
                    <a href="novo_planejamento.php?pg=novoPlanejamento">Novo Planejamento</a>
                </li>
                <li <?php echo $estilo3; ?>>
                    <a href="novo_projeto.php?pg=NovoProjetos">Novo projeto</a>
                </li>
                <li <?php echo $estilo4; ?>>
                    <a href="lista_projeto.php?pg=listaProjetos">Lista de Projetos</a>
                </li>

            </ul>
            <li <?php echo $estilo5; ?>>
                <a href="lista_participantes.php?pg=participante ">
                    <i class="material-icons">people</i>
                    <span type="Submit" class="semEstilo">Participante </span>

                </a>
            </li>


            <!--<li <?php echo $estilo8; ?>>
                <a href="certificado.php?pg=cerificado">
                    <i class="material-icons">card_membership</i>
                    <span>Certificado</span>
                </a>
                <li <?php echo $estilo9; ?>>
                    <li>
                        <a href="cracha.php?pg=cracha">
                            <i class="material-icons">assignment_ind</i>
                            <span>Crachá </span>
                        </a>
                    </li>-->

            <li <?php echo $estilo11; ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">star</i>
                    <span>Doação</span>
                </a>
                <ul class="ml-menu">
                    <li <?php echo $estilo13; ?>>
                        <a href="nova_doacao.php?pg=novoDacao">Nova doação</a>
                    </li>
                    <li <?php echo $estilo12; ?>>
                        <a href="lista_doacao.php?pg=listaDoacao">Lista de doação </a>
                    </li>
                    <li <?php echo $estilo22; ?>>
                        <a href="novo_beneficiario.php?pg=novoBen">Novo Beneficiado </a>

                    </li>
                    <li <?php echo $estilo21; ?>>
                        <a href="lista_beneficiario.php?pg=listaBen">Lista de Beneficiado </a>

                    </li>
                    <li <?php echo $estilo14 ?>>
                        <a href="ranking.php?pg=ranking">Ranking</a>
                    </li>

                    <li <?php echo $estilo23; ?>>
                        <a href="novo_donativo.php?pg=donativo">Donativos</a>
                    </li>
                    <li <?php echo $estilo24; ?>>
                        <a href="lista_donativo.php?pg=lstdonativo">Lista de Donativos</a>
                    </li>

                </ul>
            </li>
            <?php if($_SESSION['status'] == "Administrador"){?>
            <li <?php echo $estilo17; ?>>
                <a href="lista_depoimento.php?pg=depoimento">
                    <i class="material-icons">comment</i>
                    <span>Depoimento</span>
                </a>
            </li>
            <?php }?>
            <!--  <li <?php echo $estilo7; ?>>
                        <a href="email.php?pg=email">
                            <i class="material-icons">email</i>
                            <span type="Submit" class="semEstilo">E-mail </span>

                        </a>
                    </li>-->

            <li <?php echo $estilo19; ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">toc</i>
                    <span>Enquete</span>
                </a>
                <ul class="ml-menu">
                    <li <?php echo $estilo25; ?>>
                        <a href="lista_projeto_encerrado.php?pg=projetoEncerrado">Criar Enquete</a>
                    </li>
                    <li <?php echo $estilo21; ?>>
                        <a href="nova_pergunta.php?pg=novaPergunta">Nova Pergunta</a>
                    </li>
                    <li <?php echo $estilo22; ?>>
                        <a href="nova_alternativa.php?pg=novaResposta">Nova Alternativa </a>
                    </li>
                    <li <?php echo $estilo23; ?>>
                        <a href="lista_pergunta.php?pg=listaPergunta">Lista Pergunta </a>

                    </li>
                    <li <?php echo $estilo24; ?>>
                        <a href="lista_alternativa.php?pg=listaResposta">Lista Alternativas </a>

                    </li>


                </ul>
            </li>
       
            <?php
          
            if($_SESSION['status'] == "Administrador"){?>
            <li <?php echo $estilo40; ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">help</i>
                    <span>FAQ</span>
                </a>
                <ul class="ml-menu">
                    <li <?php echo $estilo30; ?>>
                        <a href="novo_faq.php?pg=faq">Novo FAQ</a>
                    </li>
                    <li <?php echo $estilo32; ?>>
                        <a href="lista_faq.php?pg=lista">Lista FAQ</a>

                    </li>
                </ul>
            </li>
           
            <li <?php echo $estilo99; ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">person</i>
                    <span>Acesso</span>
                </a>

                <ul class="ml-menu">
                    <li <?php echo $estilo999; ?>>
                        <a href="novo_pastoralista.php?pg=novoPast">Novo acesso</a>
                    </li>
                    <li <?php echo $estilo9999; ?>>
                        <a href="lista_pastoralistas.php?pg=LstPast">Lista acesso</a>

                    </li>
                </ul>
            </li>
                <?php }?>

            
            <li <?php echo $estilo33; ?>>
                <a href="lista_relatorio.php?pg=relatorio">
                    <i class="material-icons">trending_up</i>
                    <span>Relatório</span>
                </a>
            </li>
            


            <li <?php echo $estilo18; ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">person</i>
                    <span>Sorteio</span>
                </a>

                <ul class="ml-menu">
                    <li <?php echo $estilo70; ?>>
                        <a href="novo_sorteio.php?pg=sorteio">Criar Sorteio</a>
                    </li>
                    <li <?php echo $estilo80; ?>>
                        <a href="lista_sorteio.php?pg=LstSort">Lista sorteio</a>

                    </li>
                </ul>
            </li>




		<li <?php echo $estilo35; ?>>
			<a href="lista_pessoa.php?pg=pessoa">
				<i class="material-icons">people</i>
				<span type="Submit" class="semEstilo">Pessoa </span>

			</a>
		</li>
          


    </ul>
</div>
