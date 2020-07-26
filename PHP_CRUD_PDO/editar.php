<?php
	session_start();
  	include_once 'includes/header.php';
  	require_once 'vendor/autoload.php';
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$ncliente = new \App\Model\NCliente();
		$dados = $ncliente->readi($id);
	}
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
			<h3 class="light">Editar Cliente</h3>
			<form action="<?php $ncliente->update(); ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $dados['0']['id']; ?>">
				<div class="input-field col s12">
					<input type="text" name="nome" id="nome" value="<?php echo $dados['0']['nome']; ?>">
					<label for="nome">Nome</label>
				</div>
				<div class="input-field col s12">
					<input type="text" name="sobrenome" id="sobrenome" value="<?php echo $dados['0']['sobrenome']; ?>">
					<label for="sobrenome">Sobrenome</label>
				</div>
				<div class="input-field col s12">
					<input type="text" name="email" id="email" value="<?php echo $dados['0']['email']; ?>">
					<label for="email">Email</label>
				</div>
				<div class="input-field col s12">
					<input type="text" name="idade" id="idade" value="<?php echo $dados['0']['idade']; ?>">
					<label for="idade">Idade</label>
				</div>

				<button type="submit" name="btn-editar" class="btn">Atualizar</button>
				<a href="index.php" class="btn green">Lista de Clientes</a>
			</form>
		</div>
</div>

<?php
  include_once 'includes/footer.php';
?>