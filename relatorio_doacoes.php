
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('controller/ControleDoacao.php');
Doacao('consultarRelatorio');


$arquivo = 'lista_doacao.xls';

$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td colspan="3"><b>Lista de Doação</b></tr>';
$html .= '</tr>';

// titulo
$html .= '<tr>';
$html .= '<td><b>Nome Escola</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Donativo</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Pontuacão</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Quantidade</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Total</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Data da Doação</b></td>';
$html .= '</tr>';


while ($row = mysqli_fetch_array($rs)) {
    //informa��o

    $html .= '<tr>';
    $html .= '<td>' .  $row['nomeEscola'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['nome'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['pontuacao'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['quantidade'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['total'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  date("d/m/Y", strtotime( $row['data'])) . '</td>';
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