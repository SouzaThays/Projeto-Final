
<?php
require_once('controller/ControleProjeto.php');
Projeto('pesquisarLista');
?>



    <?php while ($row = mysqli_fetch_array($rs)) { ?>
        <tr>

            <td><?php echo $row['nome']; ?>
            </td>
            <td><?php echo date("d/m/Y", strtotime($row['dataInicio'])); ?>
            </td>
            <td><?php echo date("d/m/Y", strtotime( $row['dataFim'])); ?>
            </td>
            <td><?php echo $row['atuacao']; ?></td>
            <!--<td></td>-->

            <?php


              $data_atual = date("Y-m-d");
              $valida = "";

              if($row['dataFim'] < $data_atual){
                  $valida = "style='display: none;'";
              }

            ?>
            <th >

                <a href="novo_projeto.php?pg=NovoProjetos&idProjeto=<?php echo $row['idProjeto']; ?>" title="Editar" <?php echo $valida; ?>>
                    <i class="material-icons">edit</i>
                </a>
                <a href="#" title="Excluir" onclick="excluir(<?php echo $row['idProjeto']; ?>)" <?php echo $valida; ?>>
                    <i class="material-icons">delete_forever</i>
                </a>
           
                <a href="lista_inscrito.php?pg=listaProjetos&idProjeto=<?php echo $row['idProjeto']; ?>" title="Lista inscritos">
                    <i class="material-icons">list</i>
                </a>
            </th>
</tr>
        
        <?php }  ?>
        
        <?php
            $cont = $rs->num_rows;
            if($cont <= 0) { ?>
                <tr>
                    <td colspan="6">
                        <i><b>Não foi encontrado nenhum registro</b></i>
                    </td>
                 </tr>
        <?php } ?>
                                            

                                    