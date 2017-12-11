
<?php
require_once('controller/ControleEnquete.php');
Enquete('consultarAlternativaPorEnquete');
?>



<table class="table table-bordered table-striped table-hover dataTable ">
    <thead>
        <tr>
            <th>Perguntas</th>
            <th width="10">Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_array($rsEnquete)) { ?>
        <tr>
           
            <td>
                <?php echo $row['descricaoAlt']; ?>
            </td>
            <td style="display:none">
                <input type="hidden" id="idAlt" name="idAlt" value="<?php echo $row['idEnquete']; ?>" />
            </td>
            <td>
            <i class="material-icons" title="Excluir" onclick="RemoveTableRow(this)">delete_forever</i>
</td>
        </tr>
        <?php } ?>
    </tbody>
</table>

