
<?php
require_once('controller/ControleDoacao.php');
    Doacao('consultarPorDoacao');
?>



<?php while ($row = mysqli_fetch_array($rs)) { ?>
<tr>
    <td>
        <?php echo $row['nome']; ?>
    </td>
    <td>
        <?php echo $row['projeto']; ?>
    </td>
    <td>
        <?php echo date("d/m/Y", strtotime($row['dataNascimento'])); ?>
    </td>
    <td>
        <i class="material-icons" style="cursor:pointer;" onclick="abreDados(<?php echo $row['idUsuario']; ?>)">account_circle</i>
    </td>

</tr><?php } ?>
        
        <?php
        $cont = $rs->num_rows;
        if($cont <= 0) { ?>
                <tr>
                    <td colspan="6">
                        <i><b>Não foi encontrado nenhum registro</b></i>
                    </td>
                 </tr>
        <?php } ?>
                                            

                                    