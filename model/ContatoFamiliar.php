<?php

require_once('Conexao.php');

class ContatoFamiliar
{
    private $idContatoFamiliar;
    private $nome;
    private $telefone;
    private $email;
    private $grauParentesco;



    public function incluirContato($lstNomes, $lstTelefone, $lstEmail, $lstGrauParentesco,  $id) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $iNome = 0;
        foreach ($lstNomes as &  $valueNome) {
            $vNomes = $valueNome;
            $iTel = 0;

            foreach ($lstTelefone as & $valueTelefone) {
                if($iNome == $iTel){
                    $vTelefone = $valueTelefone;
                    $iEmail = 0;

                    foreach ($lstEmail as & $valueEmail) {
                        if($iTel == $iEmail){
                            $vEmail = $valueEmail;
                            $iGrauParentesco = 0;

                            foreach ($lstGrauParentesco as & $valueGrauParentesco) {
                                if($iEmail == $iGrauParentesco){
                                    $vGrauParentesco = $valueGrauParentesco;

                                    if($valueNome == "" && $valueEmail == "" && $valueTelefone == "" && $valueGrauParentesco == ""){
                                        
                                    }
                                    else{
                                        $insert = ' insert into contatofamiliar( nome, email, telefone, grauParentesco, fkUsuario)
                                        values("' . $vNomes . '", "' . $vEmail  . '", "' . $vTelefone . '" , "' . $vGrauParentesco . '"  ,  "'.  $id . '" )';
                                        $Acesso->Query($insert);
                                    }

                                }
                                $iGrauParentesco++;
                            }
                        }
                        $iEmail++;
                    }
                }
                $iTel++;
            }
            $iNome++;

        }

        }

    // ----- FUNÇÃO DE CONSULTA DE DADOS ----- //

    public function consultar($sql) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysqli_affected_rows($Acesso->result);

        $this->Result = $Acesso->result;
    }

    // ----- FUNÇÃO DE EXCLUSÃO DE DADOS ----- //

    public function excluir($lstIdEx) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        foreach ($lstIdEx as &  $valueId) {

            $vid = $valueId;
            $delete = 'delete from despesas where idDespesas="' . $vid . '"';
            $Acesso->Query($delete);
        }

    }

    // ----- FUNÇÃO DE EDIÇÃO DE DADOS ----- //

    public function alterar($lstNomes, $lstTelefone, $lstEmail, $lstGrauParentesco,  $id, $lstId) {

        $Acesso = new Acesso();
        $Acesso->Conexao();

        $insert = "";
        $iNomes = 0;
        $iid = 0;


        foreach ($lstNomes as &  $valueNomes) {

            $vNomes = $valueNomes;
            $iTelefone = 0;
            foreach ($lstTelefone as & $valueTel) {

                if($iNomes == $iTelefone){

                    $vTelefone = $valueTel;

                     $iEmail = 0;

                     foreach ($lstEmail as & $valueEmail) {
                         if($iTelefone == $iEmail){
                             $vEmail = $valueEmail;


                              $iGrauParentesco = 0;

                              foreach ($lstGrauParentesco as & $valueGrauParentesco) {
                                  if($iEmail == $iGrauParentesco){
                                      $vGrauParentesco = $valueGrauParentesco;




                                      $iid = 0;
                                      foreach ($lstId as & $valueId) {

                                          if($iNomes == $iid ){

                                              $vId = $valueId;

                                              if(empty($vId)){
                                                  //se está vazio a despesa nao existe, faz INSERT

                                                  $insert = ' insert into contatofamiliar( nome, email, telefone, grauParentesco, fkUsuario)
                                        values("' . $vNomes . '", "' . $vTelefone . '", "' . $vEmail . '" , "' . $vGrauParentesco . '"  ,  "'.  $id . '" )';
                                                  $Acesso->Query($insert);


                                              }else{
                                                  //se tem id a despesa existe, faz UPDATE

                                                  $update = 'update contatofamiliar set nome="' . $vNomes .'", email="' . $vTelefone  . '", telefone="' . $vEmail  . '", grauParentesco="' . $vGrauParentesco  . '"
                                    where idcontatoFamiliar ="' . $vId . '" and fkUsuario ="' . $id . '" ';

                                                  $Acesso->Query($update);
                                                  $this->Linha = mysqli_num_rows($Acesso->result);
                                                  $this->Result = $Acesso->result;

                                              }
                                          }
                                          $iid++;
                                      }



                                  }
                                  $iGrauParentesco++;

                              }


                         }
                         $iEmail++;
                     }





                }
                $iTelefone ++;
            }
            $iNomes++;
        }

    }
}


