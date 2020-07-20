<?php

	require_once 'db-connect.php';
	session_start();


	if(isset($_POST['entrar'])){
		$erros = array();
		$login = mysqli_escape_string($connect, $_POST['login']);
		$senha = mysqli_escape_string($connect, $_POST['senha']);
		/*
			O comando mysqli_escape_string protege o banco de dados de ataques escondidos no login
			Por exemplo:
				105 OR 1=1
				1; DROP TABLE "nome do banco de dados ou tabela"

		*/

		if(empty($login) or empty($senha)){
			$erros[] = "<li> O campo login/senha não foi preenchida </li>";
		}
		else{
			$sql = "SELECT login FROM usuarios WHERE login = '$login' ";
			$resultado = mysqli_query($connect, $sql);

			if(mysqli_num_rows($resultado) > 0){
				$senha = md5($senha);
				$sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
				$resultado = mysqli_query($connect, $sql);
				if(mysqli_num_rows($resultado) == 1){
					$dados = mysqli_fetch_array($resultado);
					mysqli_close($connect);
					$_SESSION['logado'] = true;
					$_SESSION['id_usuario'] = $dados['id'];
					header('Location: home.php');
				}
				else{
					$erros[] = "<li> usuario e senha não combinam </li>";
				}
			}
			else{
				$erros[] = "<li> usuario inexistente </li>";
			}
		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
</head>
<body>

	<h1>Login</h1>
	<?php
		if(!empty($erros)){
			foreach ($erros as $erro) {
				echo $erro;
			}
			echo "<br><hr>";
		}
	?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		LOGIN:<input type="text" name="login"><br>
		SENHA:<input type="password" name="senha"><br>
		<button name="entrar">Entrar</button>

	</form>

</body>
</html>