
<?php
require_once('controller/ControleDoacao.php');
Doacao('consultar');
?>



    <table id="tb" class="table table-bordered table-striped table-hover">
        <tbody>
            

            <tr>
                <th colspan="4">Item Doado</th>
            </tr>

            <?php while ($row = mysqli_fetch_array($rs)) { ?>
            <tr>
                    <td>
                        <b>Item: </b><?php echo $row['nome']; ?>
                    </td>
                    <td>
                        <b>Pontuação: </b><?php echo $row['pontu']; ?>
                    </td>
                    <td>
                        <b>Quantidade: </b><?php echo $row['quantidade']; ?>
                    </td>
                <td>
                    <b>Total Pontuacao: </b><?php echo $row['pontuacao']; ?>
                </td>
            </tr>
            <?php } ?> 
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <button type="button" onclick="fechar()" class="btn btn-danger waves-effect ">Fechar</button>
                </td>
            </tr>
        </tfoot>
    </table>

