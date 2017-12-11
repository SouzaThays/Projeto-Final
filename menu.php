
<?PHP
session_start();
if(isset($_SESSION['login']))
{
?> 
<nav class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
            <a class="navbar-brand" href="https://www.pucpr.br/">PUCPR</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">          
			<ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="logout.php">
                        <?PHP echo 'Olá '.$_SESSION['login'].'! Seja bem vindo(a)!'; ?>
                    </a>
                </li>
				<li>
                    <a href="logout.php">
                        <i class="material-icons">input</i>
                    </a>
				</li>

			</ul>
		</div>
	</div>
</nav>
<?PHP }
else{
    echo '<script>window.location="login.php";</script>';

}
?>


