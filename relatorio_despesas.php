
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('controller/ControleProjeto.php');
Projeto('consultarRelatorioDespesa');


$arquivo = 'lista_despesas.xls';

$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td colspan="3"><b>Lista de Despesas</b></tr>';
$html .= '</tr>';

// titulo
$html .= '<tr>';
$html .= '<td><b>Nome Projeto</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Data Início do Projeto</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Data Fim do Projeto</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Despesas</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Valor</b></td>';
$html .= '</tr>';


while ($row = mysqli_fetch_array($rs)) {
    //informa��o


    $html .= '<tr>';
    $html .= '<td>' .  $row['nome'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  date("d/m/Y", strtotime( $row['dataInicio'])) . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  date("d/m/Y", strtotime( $row['dataFim'])) . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['mnDespesas'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['valor'] . '</td>';
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