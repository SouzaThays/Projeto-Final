<?php

require_once("model/Pessoa.php");
require_once("model/ContatoFamiliar.php");

function ProcessoPessoa($Processo) {

    switch ($Processo) {


        case 'incluir':

            global $linha;
            global $rsPessoa;

            $pessoa = new Pessoa();

            $contatoFamiliar = new ContatoFamiliar();

            /*  $pessoa->consultar("select * from pessoa");
            $linha = $pessoa->Linha;
            $rs = $pessoa->Result;*/

            $_POST['dataNascimento'] = date($_POST['dataNascimento']);

            $_POST['dataNascimento'] = explode("/", $_POST['dataNascimento']);

            list($dia, $mes, $ano) = $_POST['dataNascimento'];

            $_POST['dataNascimento'] = "$ano-$mes-$dia";



            $pessoa->consultar('select cpf from pessoa where cpf = "' . $_POST['cpf'] . '" ');
            $rsPessoa = $pessoa->Result;

            $contPessoa = $rsPessoa->num_rows;


            $cpf =  $_POST['cpf'];
            $cpf = trim($cpf);
            $cpf = str_replace(".", "", $cpf);
            $cpf = str_replace(",", "", $cpf);
            $cpf = str_replace("-", "", $cpf);
            $cpf = str_replace("/", "", $cpf);

            // Verifiva se o número digitado contém todos os digitos
            if($cpf != null){
                if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
	            {
                    echo '<script>alert("CPF invalido !");</script>';
                    break;
                }
	            else
                {   // Calcula os números para verificar se o CPF é verdadeiro

                    for ($t = 9; $t < 10; $t++) {
                        for ($d = 0, $c = 0; $c < $t; $c++) {
                            $d += $cpf{$c} * (($t + 1) - $c);
                        }
                        $d = ((10 * $d) % 11) % 10;
                        if ($cpf{$c} != $d) {
                            echo '<script>alert("CPF invalido !");</script>';
                            break;
                        }

                        else{
                            if (isset($_POST['okCadastrar']) == 'true') {

                                if($contPessoa > 0){
                                    echo '<script>alert("Não foi efetuado seu cadastro! CPF já cadastrado no sistema !");</script>';
                                    break;
                                }


                                $pessoa->incluirPessoa($_POST['nome'], $_POST['email'], $_POST['dataNascimento'],
                                    $_POST['cpf'], $_POST['rg'], $_POST['orgaoExpedidor'],  $_POST['telefoneFixo'], $_POST['telefoneCelular'],
                                    $_POST['sexo'], $_POST['planoSaude'], $_POST['alergia'], $_POST['tipoSanguineo'], $_POST['endereco']);


                                $pessoa->consultar('select idUsuario from pessoa where cpf = "' . $_POST['cpf'] . '" ');
                                $rs = $pessoa->Result;
                                while ($respParticipante = mysqli_fetch_array($rs)) {
                                    $idPart = $respParticipante['idUsuario'];
                                }

                                $_POST['idUsuario'] = $idPart;

                                $pessoa->incluirParticipante($_POST['matricula'], $_POST['fkCurso'], $_POST['turno'],
                                    $_POST['periodo'], $_POST['idUsuario'], $_POST['matriculaC'],  $_POST['cargo'], $_POST['instituicao']);

                                $contatoFamiliar->incluirContato($_POST['ListaNomes'], $_POST['ListaTel'], $_POST['ListaEmail'],$_POST['ListaGrau'],
                                    $_POST['idUsuario']);

                                echo '<script>alert("Cadastrado com sucesso !");</script>';
                                echo '<script>window.location="index.php";</script>';
                            }
                        }
                    }
                }


            }

            break;

        case 'consultar':

            global $linha;
            global $rsPessoa;

            $pessoa = new Pessoa();

            $pessoa->consultar("select * from pessoa");
            $linha = $pessoa->Linha;
            $rsPessoa = $pessoa->Result;


            break;


        case 'consultarEstudante':

            global $rsPessoaC;

            $pessoa = new Pessoa();

            $pessoa->consultar("select * from estudante where fkUsuario=" . $_GET['idUsuario']);
            $rsPessoaC = $pessoa->Result;

            break;

        case 'consultarColaborador':

            global $rsPessoaColab;

            $pessoa = new Pessoa();

            $pessoa->consultar("select * from colaborador where fkUsuario=" . $_GET['idUsuario']);
            $rsPessoaColab = $pessoa->Result;

            break;



        case 'editar':

            global $linha;
            global $rs;

            $pessoa = new Pessoa();

            $pessoa->consultar("select * from pessoa where idUsuario=" . $_GET['idUsuario']);

            $linha = $pessoa->Linha;
            $rs = $pessoa->Result;

            global $linha;
            global $rsContato;
            $contato = new ContatoFamiliar();

            $contato->consultar("select * from contatofamiliar where fkUsuario=" . $_GET['idUsuario']);
            $rsContato = $contato->Result;

            $_POST['dataNascimento'] = date($_POST['dataNascimento']);

            $_POST['dataNascimento'] = explode("/", $_POST['dataNascimento']);

            list($dia, $mes, $ano) = $_POST['dataNascimento'];

            $_POST['dataNascimento'] = "$ano-$mes-$dia";

            if (isset($_POST['okEditar']) == "ok") {
                $pessoa->alterar($_POST['nome'], $_POST['email'], $_POST['dataNascimento'], $_POST['cpf'], $_POST['rg'], $_POST['orgaoExpedidor'], $_POST['telefoneFixo'], $_POST['telefoneCelular'], $_POST['sexo'], $_POST['planoSaude'], $_POST['alergia'], $_POST['tipoSanguineo'], $_POST['endereco'], $_GET['idUsuario']);
                $contato->alterar($_POST['ListaCont'], $_POST['ListaTel'], $_POST['ListaEmail'], $_POST['ListaGrau'] , $_POST['ListaId'], $_GET['idUsuario']);

                $contato->excluir($_POST['ListaIdExcluidos']);
                echo '<script>alert("Alterado com sucesso !");</script>';
                echo '<script>window.location="lista_pessoa.php?pg=pessoa";</script>';

            }

            break;

        case 'consultarPorProjeto':


            global $rsPessoa;

            $pessoa = new Pessoa();

            $strNome = $_POST['nomeProjetoPesq'];
            $strNome = "%".$strNome."%";


            if (isset($_GET['filtro']) == "ok") {

                $pessoa->consultar('select p.idUsuario, p.nome, pro.nome projeto, i.dataInscricao, i.status status from pessoa p, participante par, projeto pro,
                           inscricao i  where p.idUsuario = par.fkUsuario and par.idParticipante = i.fkParticipante
                          and pro.idProjeto = i.fkProjeto and (p.nome like "' . $strNome . '" or "' . $_POST['nomeProjetoPesq'] . '"  is null )
                        and (pro.fkPlanejamento = "' . $_POST['fkProjetoPesq'] . '" or "' . $_POST['fkProjetoPesq'] . '" = "-1" )
                        and (pro.fkPrograma = "' . $_POST['fkProgramaPesq'] . '" or "' . $_POST['fkProgramaPesq'] . '" = "-1")
                        order by i.dataInscricao, p.nome');

                $rsPessoa = $pessoa->Result;
            }
            else{

                $pessoa->consultar('select p.idUsuario, p.nome, pro.nome projeto, i.dataInscricao, i.status status from pessoa p, participante par, projeto pro, inscricao i
                                    where p.idUsuario = par.fkUsuario and par.idParticipante = i.fkParticipante
                                    and pro.idProjeto = i.fkProjeto
                                    order by i.dataInscricao, p.nome');
                $rsPessoa = $pessoa->Result;
            }

            break;

        case 'consultarRelatorioCadastro':

            global $rs;

            $pessoa = new Pessoa();

            if (isset($_GET['relat']) == 'cadastro') {
                $pessoa->consultar('select * from pessoa');
            }

            $rs = $pessoa->Result;

            break;

        case 'consultarRelatorio':

            global $rs;

            $pessoa = new Pessoa();

            if (isset($_GET['relat']) == 'cadastroPorPeriodo') {

                $_GET['vDtIni'] = explode("/", $_GET['vDtIni']);

                list($dia, $mes, $ano) = $_GET['vDtIni'];

                $dtIni = "$ano-$mes-$dia";


                $_GET['vDtFim'] = explode("/", $_GET['vDtFim']);

                list($dia, $mes, $ano) = $_GET['vDtFim'];

                $dtFim = "$ano-$mes-$dia";

                $pessoa->consultar('SELECT insc.dataInscricao, pes.rg rg , pes.nome nome,  pes.cpf cpf, insc.statusTaxa,
					            pes.idUsuario, pes.email email, insc.idInscrito, proj.nome nomeProj,
					            proj.fkPlanejamento fkPlan, proj.fkprograma programa, insc.status status, pes.telefoneCelular telCel,
                                proj.local local, proj.dataInicio dtIni, proj.dataFim dtFim, insc.dataInscricao dtInsc
					            FROM  inscricao insc, projeto proj, participante part, pessoa pes
                                where insc.fkProjeto = proj.idProjeto
                                AND  insc.fkParticipante = part.idParticipante
                                AND part.fkUsuario = pes.idUsuario
                            and "' . $dtIni . '" <= insc.dataInscricao and "' . $dtFim . '" >= insc.dataInscricao
                        order by insc.dataInscricao, pes.nome');
            }

            $rs = $pessoa->Result;

            break;

        case 'filtroPessoa':

            global $rs;

            $pessoa = new Pessoa();

            if (isset($_GET['filtro']) == 'ok') {

                $strNome = $_POST['nomeProjetoPesqPessoa'];
                $strNome = "%".$strNome."%";
                $tipo = $_POST['tipoPesqPessoa'];

                $strSQL = '';

                $strSQL = ' select  idUsuario, p.nome, p.cpf, p.email, p.telefoneCelular';

                    if ($tipo == "1" ){
                        $strSQL =  $strSQL .' ,e.idEstudante';
                    };
                    if ($tipo == "2" ){
                        $strSQL =  $strSQL . ' ,c.idColaborador';
                    }
                    if ($tipo == "3" ){
                        $strSQL =  $strSQL . ' ,ce.idComunidadeExterna';
                    }

                    $strSQL =  $strSQL . ' from  pessoa p';
                    if ($tipo == "1" ){
                        $strSQL =  $strSQL .' inner join estudante e on (p.idUsuario = e.fkUsuario) ';
                    }
                    if ($tipo == "2" ){
                        $strSQL =  $strSQL . ' inner join colaborador c on (p.idUsuario = c.fkUsuario) ';
                    }
                    if ($tipo == "3" ){
                        $strSQL =  $strSQL . ' inner join comunidadeexterna ce on (p.idUsuario = ce.fkUsuario) ';
                    }
                    $strSQL =  $strSQL . ' where (p.nome like "' . $strNome . '" or "' . $_GET['nomeProjetoPesqPessoa'] . '"  is null ) ';
                    $strSQL =  $strSQL . ' AND (p.cpf = "' . $_POST['CPFProjetoPesqPessoa'] . '" or "' . $_POST['CPFProjetoPesqPessoa'] . '" = "-1") ';
                    $strSQL =  $strSQL . ' order by nome ';

                    $pessoa->consultar($strSQL);

            }else{
                $pessoa->consultar('  select idUsuario, nome, cpf, email, telefoneCelular
                                       from  pessoa order by nome ');
            }

            $rs = $pessoa->Result;

            break;

        case 'consultarRelatorioCadastroPessoal':

            global $rs;

            $pessoa = new Pessoa();

            if (isset($_GET['relat']) == 'pessoas') {
                $pessoa->consultar('select * from pessoa where idUsuario = "' . $_GET['idPessoa'] . '" ');
            }

            $rs = $pessoa->Result;

            break;

        case 'consultarRelatorioCadastroContato':

            global $rs;

            $pessoa = new Pessoa();

            if (isset($_GET['relat']) == 'Contato') {
                $pessoa->consultar(' select p.nome nomePessoa, c.nome nomeC, c.telefone telC,
                         c.grauParentesco grau, c.email emailC from pessoa p , contatofamiliar c
			             where p.idUsuario = c.fkUsuario and
                         fkUsuario = "' . $_GET['idPessoa'] . '" ');
            }

            $rs = $pessoa->Result;

            break;



        case 'contarPessoa':

            global $rsContP;
            $pessoa = new Pessoa();
            $pessoa->consultar("select COUNT(*) from pessoa ");
            $rsContP = $pessoa->Result;


            global $rsContD;
            $pessoa = new Pessoa();
            $pessoa->consultar("select COUNT(*) from depoimento ");
            $rsContD = $pessoa->Result;

            global $rsContPR;
            $pessoa = new Pessoa();
            $pessoa->consultar("select COUNT(*) from projeto ");
            $rsContPR = $pessoa->Result;


            global $rsContB;
            $pessoa = new Pessoa();
            $pessoa->consultar("select COUNT(*) from beneficiario ");
            $rsContB = $pessoa->Result;

            global $rsContPI;
            $pessoa = new Pessoa();
            $pessoa->consultar("               SELECT pro.nome,  COUNT(*) AS quantidade
               FROM projeto pro, inscricao i where i.fkProjeto = pro.idProjeto and Year(pro.dataFim) = Year(NOW())
               GROUP BY pro.idProjeto; ");
            $rsContPI = $pessoa->Result;

            break;

        case 'consultarPorProjetoDeclaracao':


            global $rsPessoa;

            $pessoa = new Pessoa();

            $strNome = $_POST['nomeProjetoPesq'];
            $strNome = "%".$strNome."%";


            if (isset($_GET['filtro']) == "ok") {

                $pessoa->consultar('select p.idUsuario, pro.idProjeto , i.idInscrito, par.idParticipante, p.nome, pro.nome projeto, i.dataInscricao, i.status status from pessoa p, participante par, projeto pro,
                           inscricao i  where p.idUsuario = par.fkUsuario and par.idParticipante = i.fkParticipante
                          and pro.idProjeto = i.fkProjeto and (p.nome like "' . $strNome . '" or "' . $_POST['nomeProjetoPesq'] . '"  is null )
                        and (pro.fkPlanejamento = "' . $_POST['fkProjetoPesq'] . '" or "' . $_POST['fkProjetoPesq'] . '" = "-1" )
                        and (pro.fkPrograma = "' . $_POST['fkProgramaPesq'] . '" or "' . $_POST['fkProgramaPesq'] . '" = "-1")
                        and i.status = "Ativo"
                        order by i.dataInscricao, p.nome');

                $rsPessoa = $pessoa->Result;
            }
            else{

                $pessoa->consultar('select p.idUsuario, pro.idProjeto , i.idInscrito, par.idParticipante, p.nome, pro.nome projeto, i.dataInscricao, i.status status from pessoa p, participante par, projeto pro, inscricao i
                                    where p.idUsuario = par.fkUsuario and par.idParticipante = i.fkParticipante
                                    and pro.idProjeto = i.fkProjeto
                                        and i.status = "Ativo"
                                    order by i.dataInscricao, p.nome');
                $rsPessoa = $pessoa->Result;
            }

            break;

        case 'consultarDeclaracao':


            global $rs;

            $pessoa = new Pessoa();


            if (isset($_GET['imprimir']) == "ok") {

                $pessoa->consultar('select p.idUsuario, p.nome, pro.nome projeto, i.dataInscricao, pro.totalHora, pro.dataInicio
                        from pessoa p, participante par, projeto pro,
                       inscricao i  where p.idUsuario = par.fkUsuario and par.idParticipante = i.fkParticipante
                       and pro.idProjeto = "' . $_GET['idProjeto'] . '"
                       and i.idInscrito = "' . $_GET['idInscrito'] . '"
                       order by i.dataInscricao, p.nome');

                $rs = $pessoa->Result;
            }

            break;


        case 'consultarCRACHA':


            global $rs;

            $pessoa = new Pessoa();

            if (isset($_GET['imprimir']) == "ok") {

                $pessoa->consultar('select p.idUsuario, p.nome, pro.nome projeto, p.telefoneCelular, p.CPF
                        from pessoa p, participante par, projeto pro,
                       inscricao i  where p.idUsuario = par.fkUsuario and par.idParticipante = i.fkParticipante
                       and pro.idProjeto = "' . $_GET['idProjeto'] . '"
                       and i.idInscrito = "' . $_GET['idInscrito'] . '"
                       order by i.dataInscricao, p.nome');

                $rs = $pessoa->Result;
            }

            break;




    }
}