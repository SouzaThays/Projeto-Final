<?php 
 include('menu.php');
$vLogin = $_GET['login'];
if(empty($vLogin)){

    require_once('controller/ControleLogin.php'); 
    Login('incluir');  

    require_once('controller/ControlePastoralista.php'); 
    Pastoralista('incluir');  

}else{
    require_once('controller/ControlePastoralista.php'); 
    Pastoralista('editar');  
}
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>		
        <?php include('default.php'); ?>
        <?php include('script.php'); ?>

		<script>
        $(document).ready(function () {
            var $seuCampoValor = $("#cpf");
            $seuCampoValor.mask('000.000.000-00', {
                reverse: true,
               
            });
      
        });
		</script>



    </head>

<body class="theme-puc">
    <section>
        <aside id="leftsidebar" class="sidebar">
            <?php include('informacao.php'); ?>
        </aside>
    </section>
    <section class="content">
		
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="card-inside-title">Acesso</h2>
                        </div>
                        <div class="body">
							<form class="form_advanced_validation" action="" id="form" name="form" method="post">
								<?php  if(empty($vLogin)){ ?>
								<div class="demo-masked-input">
									<div class="row clearfix">
										<div class="col-md-5">
											<b>Matricula *</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control" id="matricula" name="matricula" placeholder="Nome completo" required />
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<b>CPF *</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control cpf " id="cpf" name="cpf" placeholder="Ex: 000-000-000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite CPF no formato: xxx.xxx.xxx-xx" required>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<b>Login *</b>
											<div>

												<div class="form-line">
													<input type="text" class="form-control mobile-phone-number" id="login" name="login" placeholder="Ex: Thays" required />
												</div>
											</div>
										</div>
										<div class="col-md-5">
											<b>Senha *</b>
											<div>

												<div class="form-line">
													<input type="password" class="form-control " id="senha" name="senha" placeholder="***" required/>
												</div>
											</div>
										</div>
										<div class="col-md-5">


											<b>Nível de acesso *</b>

											<select class="form-control show-tick" id="status" name="status">
												<option value="Administrado">Administrador</option>
												<option value="Pastoralista">Pastoralista</option>
											</select>
										</div>
									</div>
									<div class="button-demo">
										<input type="submit" name="idCadastrar" id="idCadastrar" value="Cadastrar" class="btn bg-puc waves-effect" />
										<input type="hidden" name="ok" id="ok" value="" />
									</div>
								</div>

<!------------------------------------------------------------------ ATUALIZAR-----------------------------------------------------------------><?php
                                       }else{
                                           while ($row1 = mysqli_fetch_array($rs)) { ?>


								<div class="demo-masked-input">
									<div class="row clearfix">
										<div class="col-md-5">
											<b>Matricula *</b>
											<div>
												<div class="form-line">
													<input type="text" class="form-control" id="matricula" name="matricula" placeholder="" value="<?php echo $row1['matricula']; ?>" required />
												</div>
											</div>
										</div>

										<div class="col-md-2">
											<b>Login *</b>
											<div>

												<div class="form-line">
													<input type="text" class="form-control mobile-phone-number" id="login" name="login" placeholder="Ex: Thays" value="<?php echo $row1['login']; ?>" disabled/>
												</div>
											</div>
										</div>
										<div class="col-md-5">
											<b>Senha *</b>
											<div>

												<div class="form-line">
													<input type="password" class="form-control " id="senha" name="senha" placeholder="***" value="<?php echo $row1['senha']; ?>"  required/>
												</div>
											</div>
										</div>
										<div class="col-md-5">


											<b>Nível de acesso </b>

											<select class="form-control show-tick" id="status" name="status">
												<option value="Administrador">Administrador</option>
												<option value="Pastoralista">Pastoralista</option>
												<option value="Desativado">Desativado</option>
											</select>
										</div>
									</div>
									<div class="button-demo">
										<input type="submit" name="idCadastrar" id="idCadastrar" value="Cadastrar" class="btn bg-puc waves-effect" />
										<input type="hidden" name="ok" id="ok" value="" />
									</div>
								</div>
								<?php
                                           }
                                       }?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>
</html>
