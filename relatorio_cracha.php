<?php

require_once('controller/ControlePessoa.php');
ProcessoPessoa('consultarCRACHA');

$TipoArquivo = 'download/modelo_cracha.rtf';
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
    $Telefone =  $row['telefoneCelular'];
    $dt = date("d-m-Y");
    $CPF =  $row['CPF'];
}

$mReg = str_replace("xxxNOMExxx","$Nome",$mReg);
$mReg = str_replace("xxxNOMEPROJETOxxx","$Projeto",$mReg);
$mReg = str_replace("xxxTELEFONExxx","$Telefone",$mReg);
$mReg = str_replace("xxxnCPFxxx","$CPF",$mReg);


// — dados
$CodigoArquivo = 'cracha_'.$Nome.'_'.$dt;

// — grava arquivo
$NomeArquivoDoc = "C:/ARQUIVOS/".$CodigoArquivo.".rtf";

$arqsai = fopen($NomeArquivoDoc,"w");
fwrite ($arqsai, $mReg, strlen($mReg));
fclose ($arqsai);

echo 1;
?>