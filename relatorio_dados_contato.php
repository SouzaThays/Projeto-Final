
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('controller/ControlePessoa.php');
ProcessoPessoa('consultarRelatorioCadastroContato');


$arquivo = 'dados_contato.xls';

$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td colspan="3"><b>Dados Contato Familiar</b></tr>';
$html .= '</tr>';

// titulo
$html .= '<tr>';
$html .= '<td><b>Nome Participante</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Nome Contato</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Telefone Contato</b></td>';
$html .= '<td></td>';
$html .= '<td><b>Grau de Parentesco</b></td>';
$html .= '<td></td>';
$html .= '<td><b>E-mail Contato</b></td>';
$html .= '</tr>';


while ($row = mysqli_fetch_array($rs)) {
    //informa��o



    $html .= '<tr>';
    $html .= '<td>' .  $row['nomePessoa'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['nomeC'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['telC'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['grau'] . '</td>';
    $html .= '<td></td>';
    $html .= '<td>' .  $row['emailC'] . '</td>';
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