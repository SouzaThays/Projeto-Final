<?php

require_once('controller/ControlePessoa.php');
ProcessoPessoa('consultarDeclaracao');

$TipoArquivo = 'download/modelo_declaracao.rtf';
$TipoArquivo = trim($TipoArquivo);
$arqnome    = $TipoArquivo;
$txt = "";

// — le arquivo
$arq = fopen($arqnome,"rb");
$mReg = fread($arq,100000000);
fclose($arq);



while ($row = mysqli_fetch_array($rs)) {
    $Nome =  $row['nome'];
    $Projeto =  $row['projeto'];
    $DataInicio =  date("d/m/Y", strtotime($row['dataInicio']));
    $dt = date("d-m-Y");
    $TotalHora =  $row['totalHora'];
}

$mReg = str_replace("xxxNOMExxx","$Nome",$mReg);
$mReg = str_replace("xxxPROJETOxxx","$Projeto",$mReg);
$mReg = str_replace("xxxDATAxxx","$DataInicio",$mReg);
$mReg = str_replace("xxxHORAxxx","$TotalHora",$mReg);


// — dados
$CodigoArquivo = 'declaracao_'.$Nome.'_'.$dt;

// — grava arquivo
$NomeArquivoDoc = "C:/ARQUIVOS/".$CodigoArquivo.".rtf";

$arqsai = fopen($NomeArquivoDoc,"w");
fwrite ($arqsai, $mReg, strlen($mReg));
fclose ($arqsai);

echo 1;
?>