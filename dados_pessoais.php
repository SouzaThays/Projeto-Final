
<?php
require_once('controller/ControleInscrito.php');
Inscrito('consultarDadosPessoais');
?>



    <table id="tb" class="table table-bordered table-striped table-hover">
        <tbody>
            <?php while ($row = mysqli_fetch_array($rs)) { ?>

            <tr>
                <th colspan="3"><?php echo $row['nome']; ?></th>
            </tr>

            <tr>
                    <td>
                        <b>E-mail: </b><?php echo $row['email']; ?>
                    </td>
                    <td>
                        <b>Telefone: </b><?php echo $row['telefoneFixo']; ?>
                    </td>
                    <td>
                        <b>Celular: </b><?php echo $row['telefoneCelular']; ?>
                    </td>
            </tr>
            <tr>
                <td>
                    <b>CPF: </b><?php echo $row['cpf']; ?>
                </td>
                <td>
                    <b>RG: </b><?php echo $row['rg']; ?>
                </td>
                <td>
                    <b>Data Nascimento: </b><?php echo date("d/m/Y", strtotime($row['dataNascimento'])); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Plano de Saúde: </b><?php echo $row['planoSaude']; ?>
                </td>
                <td>
                    <b>Alergia:</b> <?php echo $row['alergia']; ?>
                </td>
                <td>
                    <b>Tipo Sanguíneo: </b><?php echo $row['tipoSanguineo']; ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Endereço:</b> <?php echo $row['endereco']; ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <button type="button" onclick="fechar()" class="btn btn-danger waves-effect ">Fechar</button>
                </td>
            </tr>
        </tfoot>
    </table>

