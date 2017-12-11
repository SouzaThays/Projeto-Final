
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('controller/ControlePessoa.php');
ProcessoPessoa('consultarRelatorioCadastroPessoal');


$arquivo = 'dados_pessoais.xls';

$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td colspan="3"><b>Dados Pessoais</b></tr>';
$html .= '</tr>';

// titulo
$html .= '<tr>';
$html .= '<td><b>Nome</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Telefone</b></td>';
$html .= '<td></td>';
$html .= '<td><b>E-mail</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Sexo</b></td>';
$html .= '<td></td>';
$html .= '<td><b>CPF</b></td>';
$html .= '<td></td>';
$html .= '<td><b>RG</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Data de Nascimento</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Plano de Saúde</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Endereço</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Alergia</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Tipo Sanguíneo</b></td>';
$html .= '</tr>';


while ($row = mysqli_fetch_array($rs)) {
    //informa��o



    $html .= '<tr>';
    $html .= '<td>' .  $row['nome'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['telefoneCelular'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['email'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['sexo'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['cpf'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['rg'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  date("d/m/Y", strtotime( $row['dataNascimento'])) . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['planoSaude'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['endereco'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['alergia'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['tipoSanguineo'] . '</td>';
    $html .= '</tr>';


}
$html .= '</table>';

// ********************************//
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
// ********************************//
echo $html;
exit;

?>