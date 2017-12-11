
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('controller/ControleProjeto.php');
Projeto('consultarRelatorio');


$arquivo = 'lista_projetos.xls';

$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td colspan="3"><b>Lista de Projetos</b></tr>';
$html .= '</tr>';

// titulo
$html .= '<tr>';
$html .= '<td><b>Nome</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Data Início do Projeto</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Data Fim do Projeto</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Assessoria</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Responsável</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Número de Vagas</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Certificado Projeto Comunitário</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Certificado Hora Complementar</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Local</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Planejamento</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Programa</b></td>';
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
    $html .= '<td>' .  $row['assessoria'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['responsavel'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['numVagas'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['certifPC'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['certifHC'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['local'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['atuacao'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['des'] . '</td>';
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