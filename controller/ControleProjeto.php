<?php
require_once("model/Projeto.php");
require_once("model/Despesa.php");
require_once("model/Inscrito.php");

function Projeto($Processo) {

    switch ($Processo) {

        case 'incluir':

            $projeto = new Projeto();
            $despesa = new Despesa();

            if (isset($_POST['okCadastrar']) == 'true') {

                if($_POST['dataInicio'] < $_POST['dataAtual']){
                    echo '<script>alert("Data Inicial é menor que a data atual !");</script>';
                }
                elseif($_POST['dataInicio'] > $_POST['dataFim']){
                    echo '<script>alert("Data inicial é maior que a data Final !");</script>';
                }
                else{

                    $_POST['dataInicio'] = explode("/", $_POST['dataInicio']);

                    list($dia, $mes, $ano) = $_POST['dataInicio'];

                    $_POST['dataInicio'] = "$ano-$mes-$dia";


                    $_POST['dataFim'] = explode("/", $_POST['dataFim']);

                    list($dia, $mes, $ano) = $_POST['dataFim'];

                    $_POST['dataFim'] = "$ano-$mes-$dia";


                    $projeto->incluir($_POST['nome'],$_POST['dataInicio'], $_POST['dataFim'], $_POST['informacao'],
                        $_POST['assessoria'], $_POST['responsavel'], $_POST['numVagas'], $_POST['valorTaxa'],
                        $_POST['certifPC'],$_POST['certifHC'], $_POST['local'], $_POST['fkprograma'],  $_POST['fkPlanejamento'], $_POST['tipo']);


                    $despesa->incluir($_POST['ListaDespesas'],$_POST['ListaValores'],$_POST['nome'],$_POST['dataInicio'], $_POST['dataFim'],
                        $_POST['fkprograma'],  $_POST['fkPlanejamento']);


                    echo '<script>alert("Cadastrado com sucesso !");</script>';
                    echo '<script>window.location="lista_projeto.php";</script>';
                }
            }

            break;

        case 'consultar':

            global $rs;

            $projeto = new Projeto();

            $projeto->consultar("select * from projeto order by dataInicio, nome");
            $rs = $projeto->Result;

            break;

        case 'consultarPInscricao':

            global $rs;

            $projeto = new Projeto();

            $projeto->consultar(" select * from projeto
                            where dataFim >= now()
                            order by dataInicio, nome ");
            $rs = $projeto->Result;

            break;
        case 'editar':

            global $rs;


            global $rsDesp;

            $projeto = new Projeto();
            $despesa = new Despesa();

            $projeto->consultar("select * from projeto where idProjeto=" . $_GET['idProjeto']);
            $rs = $projeto->Result;

            $despesa->consultar("select * from despesas where idProjeto=" . $_GET['idProjeto']);
            $rsDesp = $despesa->Result;


            $_POST['dataInicio'] = explode("/", $_POST['dataInicio']);

            list($dia, $mes, $ano) = $_POST['dataInicio'];

            $_POST['dataInicio'] = "$ano-$mes-$dia";


            $_POST['dataFim'] = explode("/", $_POST['dataFim']);

            list($dia, $mes, $ano) = $_POST['dataFim'];

            $_POST['dataFim'] = "$ano-$mes-$dia";

            if (isset($_POST['okEditar']) == "true") {

                $projeto->alterar($_POST['nome'],$_POST['dataInicio'], $_POST['dataFim'], $_POST['informacao'],
                    $_POST['assessoria'], $_POST['responsavel'], $_POST['numVagas'], $_POST['valorTaxa'],
                    $_POST['certifPC'],$_POST['certifHC'], $_POST['local'], $_POST['fkprograma'],  $_POST['fkPlanejamento'], $_GET['idProjeto'], $_POST['tipo']);

                $despesa->alterar($_POST['ListaDespesas'],$_POST['ListaValores'], $_POST['fkPlanejamento'],
                    $_GET['idProjeto'],$_POST['ListaId']);

                $despesa->excluir($_POST['ListaIdExcluidos']);


                echo '<script>alert("Alterado com sucesso !");</script>';
                echo '<script>window.location="lista_projeto.php";</script>';

            }

            break;

        case 'inscricao':

            $inscrito = new Inscrito();

            if (isset($_GET['inscricao']) == "incluir") {
                $inscrito->incluirInscrito($_GET['idProjeto'],$_GET['cpf']);
            }
            break;

        case 'pesquisarLista':

            global $rs;

            $projeto = new Projeto();
            $despesa = new Despesa();

            $strNome = $_POST['nomeProjetoPesq'];
            $strNome = "%".$strNome."%";


            if (isset($_GET['filtro']) == "ok") {
                $projeto->consultar('select *, pl.dataInicio, pl.dataFim from projeto p , programa, planejamento pl
                        where idPrograma = fkPrograma and pl.idPlanejamento = fkPlanejamento and (nome like "' . $strNome . '" or "' . $_POST['nomeProjetoPesq'] . '"  is null )
                        and (fkPlanejamento = "' . $_POST['fkProjetoPesq'] . '" or "' . $_POST['fkProjetoPesq'] . '" = "-1" )
                        and (fkPrograma = "' . $_POST['fkProgramaPesq'] . '" or "' . $_POST['fkProgramaPesq'] . '" = "-1")
                        order by p.dataInicio, p.nome ');

                $rs = $projeto->Result;
            }
            else{

                if (isset($_GET['excluir']) == "ok"){

                    $projeto->excluir($_GET['idProjeto']);
                }
                $projeto->consultar("select * from projeto, programa where idPrograma = fkPrograma order by dataInicio, nome");
                $rs = $projeto->Result;
            }


            break;


        case 'projetoEncerrado':

            global $rs;
            global $rsEnquete;
            $projeto = new Projeto();
            $despesa = new Despesa();


            $strNome = $_POST['nomeProjetoPesq'];
            $strNome = "%".$strNome."%";


            if (isset($_GET['filtro']) == "ok") {
                $projeto->consultar('select * from projeto, programa
                        where idPrograma = fkPrograma and (nome like "' . $strNome . '" or "' . $_POST['nomeProjetoPesq'] . '"  is null )
                        and (fkPlanejamento = "' . $_POST['fkProjetoPesq'] . '" or "' . $_POST['fkProjetoPesq'] . '" = "-1" )
                        and (fkPrograma = "' . $_POST['fkProgramaPesq'] . '" or "' . $_POST['fkProgramaPesq'] . '" = "-1")
                        and (dataFim <= CURDATE())

                        order by dataInicio, nome ');

                $rs = $projeto->Result;
            }
            else{

                if (isset($_GET['excluir']) == "ok"){

                    $projeto->excluir($_GET['idProjeto']);
                }
                $projeto->consultar("select * from oep.projeto, oep.programa where idPrograma = fkPrograma AND dataFim <= CURDATE()  order by dataInicio, nome;");
                $rs = $projeto->Result;


                $projeto->consultar("select * from oep.enquete, oep.projeto where enquete.fkProjeto = projeto.idProjeto AND inicio <= CURDATE();");
                $rsEnquete = $projeto->Result;

            }

            break;

        case 'visualizarProjetoEncerrado':

            global $rs;

            $projeto = new Projeto();
            $despesa = new Despesa();

            $strNome = $_POST['nomeProjetoPesq'];
            $strNome = "%".$strNome."%";

            $projeto->consultar('select * from projeto , enquete
                        where dataFim <= CURDATE() and fkProjeto = idProjeto and inicio <= CURDATE() and fim >= CURDATE()
                        order by dataInicio, nome ');

            $rs = $projeto->Result;

            if (isset($_GET['excluir']) == "ok"){

                $projeto->excluir($_GET['idProjeto']);
            }
            $projeto->consultar("select DISTINCT inicio, idProjeto, nome, fim, dataInicio, dataFim, local, informacao from oep.projeto, oep.programa, oep.enquete where idPrograma = fkPrograma AND dataFim <= now() and inicio <= now() and  fim >= now() and fkProjeto = idProjeto order by dataInicio, nome");
            $rs = $projeto->Result;

            break;

        case 'consultarRelatorio':

            global $rs;

            $despesa = new Despesa();

            if (isset($_GET['relat']) == 'despesa') {


                $strNome = $_GET['nomeProjetoPesq'];
                $strNome = "%".$strNome."%";

                $despesa->consultar(' select *, plan.descricao des, prog.atuacao atuacao
                                    from projeto proj, programa prog, planejamento plan
                                    where proj.fkprograma = prog.idprograma and proj.fkPlanejamento = plan.idPlanejamento

                                AND (proj.nome like "' . $strNome . '" or "' . $_GET['nomeProjetoPesq'] . '"  is null )
                                AND (proj.fkPlanejamento = "' . $_GET['vPlanejamento'] . '" or "' . $_GET['vPlanejamento'] . '" = "-1" )
                                AND (proj.fkprograma = "' . $_GET['vPrograma'] . '" or "' . $_GET['vPrograma'] . '" = "-1" )');

            }


            $rs = $despesa->Result;

            break;

        case 'consultarRelatorioDespesa':

            global $rs;

            $despesa = new Despesa();

            if (isset($_GET['relat']) == 'projeto') {


                $strNome = $_GET['nomeProjetoPesq'];
                $strNome = "%".$strNome."%";

                $despesa->consultar('select proj.nome nome, proj.dataInicio dataInicio, proj.dataFim dataFim,  ds.mnDespesas mnDespesas, ds.valor valor
                                from projeto proj, despesas ds
                                where (proj.nome like "' . $strNome . '" or "' . $_GET['nomeProjetoPesq'] . '"  is null )
                                AND (proj.fkPlanejamento = "' . $_GET['vPlanejamento'] . '" or "' . $_GET['vPlanejamento'] . '" = "-1" )
                                AND (proj.fkprograma = "' . $_GET['vPrograma'] . '" or "' . $_GET['vPrograma'] . '" = "-1" )');

            }


            $rs = $despesa->Result;

            break;

       


    }






}
