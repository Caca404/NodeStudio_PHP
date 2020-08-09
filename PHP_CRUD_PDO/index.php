<?php
	session_start();
	require_once 'vendor/autoload.php';
	require_once 'includes/header.php';
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
		<div class="col s12 m8 push-m2">
			<h3 class="light">Clientes</h3>
			<table class="striped">
				<thead>
					<tr>
						<th>Nome:</th>
						<th>Sobrenome:</th>
						<th>Email:</th>
						<th>Nascimento:</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$ncliente = new \App\Model\NCliente();
						$dados = $ncliente->read();
						if(count($dados) > 0):
							foreach ($dados as $registro):
					?>
					<tr>
						<td><?php echo $registro['nome']; ?></td>
						<td><?php echo $registro['sobrenome']; ?></td>
						<td><?php echo $registro['email']; ?></td>
						<td><?php echo $registro['nascimento']; ?></td>
						<td><a href="editar.php?id=<?php echo $registro['id']; ?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>

						<td><a href="#modal<?php echo $registro['id'];?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

						<div id="modal<?php echo $registro['id'];?>" class="modal">
						    <div class="modal-content">
						    	<h4>Opa!</h4>
						    	<p>Are you sure about that?</p>
						    </div>
						    <div class="modal-footer">
						      	<form action="<?php $ncliente->deletar()?>" method="POST">
							     	<input type="hidden" name="id" value="<?php echo $registro['id'];?>">
							     	<button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>
							     	<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
						      	</form>
						    </div>
						</div>
					</tr>
					<?php 
							endforeach;
						else:
					?>
							<tr>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
					<?php	
						endif;
					?>
				</tbody>
			</table>
			<br>
			<a href="adicionar.php" class="btn">Adicionar cliente</a>
			<a href="enviar.php" class="btn" name="btn-enviar">Enviar Email</a>
		</div>
</div>
<?php
	require_once 'includes/footer.php';
?>