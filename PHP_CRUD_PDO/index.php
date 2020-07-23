<?php

	require_once 'vendor/autoload.php';
	require_once 'includes/header.php';

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
						<th>Idade:</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$prodDao = new \App\Model\ProdutoDao();
						$dados = $prodDao->read();
						if(count($dados) > 0):
							foreach ($dados as $registro):
					?>
					<tr>
						<td><?php echo $registro['nome']; ?></td>
						<td><?php echo $registro['sobrenome']; ?></td>
						<td><?php echo $registro['email']; ?></td>
						<td><?php echo $registro['idade']; ?></td>
						<td><a href="editar.php?id=<?php echo $registro['id']; ?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>

						<td><a href="#modal<?php echo $registro['id'];?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

						<div id="modal<?php echo $registro['id'];?>" class="modal">
						    <div class="modal-content">
						    	<h4>Opa!</h4>
						    	<p>Are you sure about that?</p>
						    </div>
						    <div class="modal-footer">
						      	<form action="<?php $prodDao->deletar()?>" method="POST">
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
		</div>
</div>


<?php
	
	require_once 'includes/footer.php';

?>




	<!-- $prod = new \App\Model\Produto();
	$prod->setId(1);
	$prod->setNome('Cadeira');
	$prod->setDescr('Gamer');

	$prodDao = new \App\Model\ProdutoDao();
	$prodDao->delete(2);
	$prodDao->read();

	foreach ($prodDao->read() as $pr) {
		echo $pr['nome']."<br>".$pr['descricao'].'<hr>';
	} -->