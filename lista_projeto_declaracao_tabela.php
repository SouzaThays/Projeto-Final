
<?php
require_once('controller/ControlePessoa.php');
ProcessoPessoa('consultarPorProjetoDeclaracao');
?>



<?php while ($row = mysqli_fetch_array($rsPessoa)) { ?>
<tr>
    <td>
        <?php echo $row['nome']; ?>
    </td>
    <td>
        <?php echo $row['projeto']; ?>
    </td>
    <td>
        <?php echo date("d/m/Y", strtotime($row['dataInscricao'])); ?>
    </td>
    <td>
        <?php echo $row['status']; ?>
    </td>
    <td>
        <i class="material-icons" style="cursor:pointer;" onclick="abreDeclaracao(<?php echo $row['idInscrito']; ?>,<?php echo $row['idProjeto']; ?>)">file_download</i>
    </td>
    <td>
        <i class="material-icons" style="cursor:pointer;" onclick="abreCracha(<?php echo $row['idInscrito']; ?>,<?php echo $row['idProjeto']; ?>)">picture_in_picture_alt</i>
    </td>
    

</tr><?php } ?>

<?php
$cont = $rsPessoa->num_rows;
if($cont <= 0) { ?>
<tr>
    <td colspan="6">
        <i>
            <b>Não foi encontrado nenhum registro</b>
        </i>
    </td>
</tr>
<?php } ?>


