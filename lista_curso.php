
<?php
require_once('controller/ControleCurso.php');
Curso('consultar');
?>


    <b>Curso</b>

<select class="form-control show-tick" id="fkCurso" name="fkCurso">
    <?php 
    $cont = $rs->num_rows;
    while ($row3 = mysqli_fetch_array($rs)) { 
        if($cont > 0) { ?>
                <option value="<?php echo $row3['idCurso']; ?>"><?php echo $row3['nome']; ?></option><?php } } ?>
        <?php if($cont <= 0) { ?>
                <option value="-1">Selecionar Escola</option><?php  } ?>   


    
</select>