<?php
require_once('controller/ControleInscrito.php');
Inscrito('consultExcluir');
?>

<div class="body">
    <ul class="list-group">   

        <?php while ($row = mysqli_fetch_array($rs)) { ?>
            <li class="list-group-item">
                    <b>Data Inscrição:</b> <?php echo $row['dtInscricao']; ?>  |
                    <b>Atividade:</b> <?php echo $row['ativ']; ?>
                <i class="material-icons" style="cursor:pointer;" onclick="excluirId(<?php echo $row['id']; ?>)">clear</i>
            </li>
        <?php }  ?>  
        

        <?php
        $cont = $rs->num_rows;
        if($cont <= 0) { ?>
        <li class="list-group-item">
            <i>Nenhuma informação encontrada.</i>
        </li>
        <?php } ?>

    </ul>
</div>




