
<?php
require_once('controller/ControleProjeto.php');
Projeto('projetoEncerrado');
?>



    <?php

    while ($row = mysqli_fetch_array($rs)) {
  
    ?>
        <tr>
        
            <td><?php echo $row['nome']; ?>
            </td>
            <td><?php echo date("d/m/Y", strtotime($row['dataInicio'])); ?>
            </td>
            <td><?php echo date("d/m/Y", strtotime( $row['dataFim'])); ?>
            </td>
            <td><?php echo $row['atuacao']; ?></td>


            <th>
               <i class="material-icons" style="cursor:pointer;" onclick="abrirRelEnquete(<?php echo $row['idProjeto']; ?>)">file_download</i>
			</th>	
        </tr>
        
        <?php 
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
                                            

                                    