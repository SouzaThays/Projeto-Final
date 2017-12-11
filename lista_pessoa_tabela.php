
<?php
require_once('controller/ControlePessoa.php');
    ProcessoPessoa('consultar');
?>



<?php while ($row = mysqli_fetch_array($rsPessoa)) { ?>
<tr>
    <td>
        <?php echo $row['nome']; ?>
    </td>
    <td>
        <?php echo $row['cpf']; ?>
    </td>
   
    <td>
        <i class="material-icons" style="cursor:pointer;" onclick="abreDados(<?php echo $row['idUsuario']; ?>)">account_circle</i>
        <a href="editar_pessoa.php?pg=pessoa&idUsuario=<?php echo $row['idUsuario']; ?>" title="Editar">
            <i class="material-icons">edit</i>
        </a>
    </td>

</tr><?php } ?>
        
        <?php
        $cont = $rsPessoa->num_rows;
        if($cont <= 0) { ?>
                <tr>
                    <td colspan="6">
                        <i><b>Não foi encontrado nenhum registro</b></i>
                    </td>
                 </tr>
        <?php } ?>
                                            

                                    