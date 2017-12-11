<?php include('menu_entrada.php'); ?>

<?php


require_once('controller/ControleEnquete.php');
Enquete('listar');

require_once('controller/ControleEnquete.php');
Enquete('incluirRespostaEnq');

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('default.php'); ?>
    <?php include('script.php'); ?>
</head>

<body class="theme-puc">
    <section>
        <aside id="leftsidebar" class="sidebar">
			<?php include('informacao_participante.php'); ?>
        </aside>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Enquete
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <form id="conteudo">
                                    <div class="form-line">
                                      
                                    </div>
                                <table id="tbEnquete"  class="table table-bordered table-striped table-hover dataTable ">
                                    <thead>
                                        <tr>
                                            <th>Enquete</th>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($rs)) { 
                                                  $cont = $cont + 1;
                                        ?>
                                        <tr>
                                      <td colspan="2">
                                          <?php echo  $cont; ?>
                                          )
                                          <?php echo  $row['descricao']; ?> 
                                            </td>
                                        </tr>
                                        <?php
                                                  require_once('controller/ControleEnquete.php');
                                                  Enquete('listarEnquete');
                                        ?>
                                        <?php while ($row1 = mysqli_fetch_array($rsEnquetePergunta)) {
                                                  $var = $row['fkPerguntas'];
                                                  $var1 = $row1['fkPerguntas'];
                                                  if($var == $var1){
										?>
                                        <tr>
                                            <td>
                                                
                                                <input name="<?php echo $row1['fkPerguntas'] ; ?>" type="radio" id="<?php echo $row1['descricaoAlt'] ; ?><?php echo $row1['fkPerguntas'] ; ?>" value="sim" class="radio-col-red" checked />
                                                <label for="<?php echo $row1['descricaoAlt']; ?><?php echo $row1['fkPerguntas'] ; ?>"><?php echo $row1['descricaoAlt']; ?></label>
                                                <input type="hidden" name="fkAlternativa" id="fkAlternativa" value="<?php echo $row1['descricaoAlt']; ?>" />
                                                <input type="hidden" name="alternativa" id="alternativa" value="<?php echo $row1['idAlternativas']; ?>" />
                                                <input type="hidden" name="fkPergunta" id="fkPergunta" value="<?php echo $row1['fkPerguntas']; ?>" />
                                                <input type="hidden" class="form-control " name="idProjeto" id="idProjeto" value="<?php echo $_GET['idProjeto']; ?>" />
                                                <input type="hidden" class="form-control " name="idInsc" id="idInsc" value="<?php echo $_GET['cpf']; ?>" />
                                                <input type="hidden" class="form-control " name="idEnquete" id="idEnquete" value="<?php echo $row1['idEnquete']; ?>" />
                                            </td>
                                        
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php } ?>
                                      
                                    </tbody>
                                </table>
                                </form>
                                <div class="button-demo">
                                    <input type="button" name="cadastrar" id="cadastrar" value="Enviar" class="btn btn-danger waves-effect" onclick="cadastrar()" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>


<script>


    cadastrar = function () {

        var check = document.getElementsByName("idDonativo");

        $('#tbEnquete').find('tr').each(function (indice) {
            $(this).find('td').each(function (indice) {

                idPerg = $(this).find('#fkPergunta').val();
                idAlter = $(this).find('#fkAlternativa').val();
                strDon = idAlter + idPerg;
                idProj = $(this).find('#idProjeto').val();
                idInsc = $(this).find('#idInsc').val();
                idEnq = $(this).find('#idEnquete').val();
                idAlternativa = $(this).find('#alternativa').val();
                

                if ($("#" + strDon).is(':checked')) {
                    
                    $('<input/>', {
                        type: 'hidden',
                        name: 'listaAlternativa[]',
                        value: idAlternativa
                    }).appendTo('#conteudo');
                

           

                    $('<input/>', {
                        type: 'hidden',
                        name: 'listaPergunta[]',
                        value: idPerg
                    }).appendTo('#conteudo');


                    $('<input/>', {
                        type: 'hidden',
                        name: 'idProjeto',
                        value: idProj
                    }).appendTo('#conteudo');


                    $('<input/>', {
                        type: 'hidden',
                        name: 'idInsc',
                        value: idInsc
                    }).appendTo('#conteudo');


                    $('<input/>', {
                        type: 'hidden',
                        name: 'fkEnquete[]',
                        value: idEnq
                    }).appendTo('#conteudo');

                }

            });

        });
      

       

        var $form = $('#conteudo');

        $.post('enquete_inscrito.php?cria=ok', $form.serialize(), function (resposta) {
            alert("Cadastrado com sucesso !");
        });
        window.location = "index.php";


    }
</script>