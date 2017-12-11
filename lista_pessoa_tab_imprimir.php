
<?php
require_once('controller/ControlePessoa.php');
ProcessoPessoa('filtroPessoa');
?>



<?php while ($row = mysqli_fetch_array($rs)) {  ?>

<tr>

    <td>
        <?php echo $row['nome']; ?>
    </td>
    <td>
        <?php echo $row['cpf']; ?>
    </td>
    <td>
        <?php echo $row['email']; ?>
    </td>
    <td>
        <?php echo $row['telefoneCelular']; ?>
    </td>

    <th>
        <i class="material-icons" style="cursor:pointer;" onclick="abrirRelPessoal(<?php echo $row['idUsuario']; ?>)">file_download</i>
        <i class="material-icons" style="cursor:pointer;" onclick="abrirRelContato(<?php echo $row['idUsuario']; ?>)">person_outline</i>
    </th>
</tr>


<?php
      } ?>

<?php
$cont = $rs->num_rows;
if($cont <= 0) { ?>
<tr>
    <td colspan="6">
        <i>
            <b>Não foi encontrado nenhum registro</b>
        </i>
    </td>
</tr>
<?php } ?>


