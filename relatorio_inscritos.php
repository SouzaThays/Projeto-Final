
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('controller/ControleInscrito.php');
Inscrito('consultarRelatorios');


$arquivo = 'lista_inscritos.xls';

$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td colspan="3"><b>Lista de Inscritos</b></tr>';
$html .= '</tr>';

// titulo
$html .= '<tr>';
$html .= '<td><b>Nome Inscrito</b></td>';
$html .= '<td></td>';
$html .= '<td><b>CFP</b></td>';
$html .= '<td></td>';
$html .= '<td><b>RG</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Telefone Celular</b></td>';
$html .= '<td></td>';
$html .= '<td><b>E-mail</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Data Inscrição</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Projeto</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Data Início</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Data Fim</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Local</b></td>';
$html .= '</tr>';


while ($row = mysqli_fetch_array($rs)) {
    //informa��o


    $html .= '<tr>';
    $html .= '<td>' .  $row['nome'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['cpf'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['rg'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['telCel'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['email'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  date("d/m/Y", strtotime( $row['dtInsc'])) . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['nomeProj'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  date("d/m/Y", strtotime( $row['dtIni'])) . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  date("d/m/Y", strtotime( $row['dtFim'])) . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['local'] . '</td>';
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