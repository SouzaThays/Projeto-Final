
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('controller/ControleEnquete.php');
Enquete('consultarRelatorio');


$arquivo = 'lista_enquete.xls';

$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td colspan="3"><b>Lista de Respostas</b></tr>';
$html .= '</tr>';

// titulo
$html .= '<tr>';
$html .= '<td><b>Nome Projeto</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Nome Participante</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Pergunta</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Resposta</b></td>';
$html .= '</tr>';


while ($row = mysqli_fetch_array($rs)) {
    //informa��o


    $html .= '<tr>';
    $html .= '<td>' .  $row['nomeProj'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['nome'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['pergunta'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['resposta'] . '</td>';
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