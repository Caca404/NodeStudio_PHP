<?php

	require_once 'db-connect.php';
	session_start();

	if(!isset($_SESSION['logado'])){
		header('Location: index.php');
	}

	$id = $_SESSION['id_usuario'];
	$sql = "SELECT * FROM usuarios WHERE id = '$id' ";
	$resultado = mysqli_query($connect, $sql);
	$dados = mysqli_fetch_array($resultado);
	mysqli_close($connect);
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pagina restrita</title>
</head>
<body>

	<h1>Olá <?php echo $dados['nome']; ?></h1>
	<a href="logout.php">sair</a>

</body>
</html>