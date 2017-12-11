
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('controller/ControleBeneficiario.php');
Beneficiario('consultarRelatorio');


$arquivo = 'lista_beneficiado.xls';

$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td colspan="3"><b>Lista de Beneficiado</b></tr>';
$html .= '</tr>';

// titulo
$html .= '<tr>';
$html .= '<td><b>Nome Beneficiado</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Telefone</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Nome Responsável</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Endere�o</b></td>';
$html .= '</tr>';


while ($row = mysqli_fetch_array($rs)) {
    //informa��o


    $html .= '<tr>';
    $html .= '<td>' .  $row['nome'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['telefone'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['nomeResponsavel'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['endereco'] . '</td>';
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