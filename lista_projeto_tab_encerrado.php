
<?php
require_once('controller/ControleProjeto.php');
Projeto('projetoEncerrado');
?>



    <?php




    while ($row = mysqli_fetch_array($rs)) {
        $Proj = $row['idProjeto'];

        //  while ($row1 = mysqli_fetch_array($rsEnquete)) {

        // $idProj = $row1['fkProjeto'];
        // $inicio = $row1['inicio'];


        

    ?>
        <tr>
        
            <td><?php echo $row['nome']; ?>
            </td>
            <td><?php echo date("d/m/Y", strtotime($row['dataInicio'])); ?>
            </td>
            <td><?php echo date("d/m/Y", strtotime( $row['dataFim'])); ?>
            </td>
            <td><?php echo $row['atuacao']; ?></td>

            <?php

        //if($idProj == $Proj){
        $data_atual = date("Y-m-d");
        $valida = "";

        if($inicio < $data_atual  && $inicio != "0000-00-00"){

            $inicio = $row['inicio'];
            echo $inicio;
            $valida = "style='display: none;'";
        }
        // }

            ?>

            <th>
                <a href="lista_inscrito_proj_encerrados.php?pg=projetoEncerrado&idProjeto=<?php echo $row['idProjeto']; ?>" title="Enviar Email">
                    <i class="material-icons">list</i>
                </a>
                <a href="lista_alternativa_pergunta.php?pg=projetoEncerrado&idProjeto=<?php echo $row['idProjeto']; ?>" title="Adicionar Pergunta/Alternativas" >
                    <i class="material-icons">add_circle</i>
                </a>
                <a href="lista_perguntas.php?pg=projetoEncerrado&idProjeto=<?php echo $row['idProjeto']; ?>" title="Editar Enquete" 
                    <i class="material-icons">edit</i>
                </a>
                <a href="lista_proj_encerrados_data.php?pg=projetoEncerrado&idProjeto=<?php echo $row['idProjeto']; ?>" title="Inserir periodo de vigência">
                    <i class="material-icons">date_range</i>
                </a>

				
        </tr><?php 
                                                                                            
                                                                                            //  }
    } ?>
        
        <?php
        $cont = $rs->num_rows;
        if($cont <= 0) { ?>
                <tr>
                    <td colspan="6">
                        <i><b>Não foi encontrado nenhum registro</b></i>
                    </td>
                 </tr>
        <?php } ?>
                                            

                                    