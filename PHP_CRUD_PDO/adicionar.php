<?php
	session_start();
  	include_once 'includes/header.php';
  	require_once 'vendor/autoload.php';
	$ncliente = new \App\Model\NCliente();
	$clien = new \App\Model\Cliente();
  	if(isset($_SESSION['mensagem'])):
?>
		
		<script type="text/javascript">
			window.onload = function(){
				M.toast({html: '<?php echo $_SESSION['mensagem']; ?>'})
			};
		</script>
<?php
	endif;
	session_unset();
?>

<div class="row">
		<div class="col s12 m6 push-m3">
			<h3 class="light">Novo Cliente</h3>
			<form action="<?php $ncliente->create(); ?>" method="POST">
				<div class="input-field col s12">
					<input type="text" name="nome" id="nome">
					<label for="nome">Nome</label>
				</div>
				<div class="input-field col s12">
					<input type="text" name="sobrenome" id="sobrenome">
					<label for="sobrenome">Sobrenome</label>
				</div>
				<div class="input-field col s12">
					<input type="text" name="email" id="email">
					<label for="email">Email</label>
				</div>
				<div class="input-field col s12">
					<input type="date" name="nascimento" id="nascimento">
					<label for="nascimento">Nascimento</label>
				</div>

				<button type="submit" name="btn-cadastrar" class="btn">Cadastrar</button>
				<a href="index.php" class="btn green">Lista de Clientes</a>
			</form>
		</div>
</div>

<?php
  include_once 'includes/footer.php';
?>