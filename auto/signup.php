<?
$dbc = mysqli_connect('localhost', 'root', 'root', 'test'); //Подключение к БД 
if(isset($_POST['submit'])){
	$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
	$login = mysqli_real_escape_string($dbc, trim($_POST['login']));
	$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
	if(!empty($username) && !empty($login) && !empty($password)){
		$query = "SELECT * FROM `signup` WHERE login = '$login'";
		$data = mysqli_query($dbc, $query);
		if(mysqli_num_rows($data) == 0){ 
			$query = "INSERT INTO `signup` (username, login, password) VALUES ('$username', '$login', '$password')";
			mysqli_query($dbc,$query);
			echo 'Вы зарегистрировались';
			mysqli_close($dbc);
			exit();
		}

		else{
			echo 'Логин уже существует';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title>Регистрация</title>
</head>
<body>
	<form method="POST" action="<? echo $_SERVER['PHP_SELF']; ?>">
		<label for="username">Ваше имя:</label>
		<input type="text" name="username">
		<label for="login">Логин:</label>
		<input type="text" name="login">
		<label for="password">Пароль:</label>
		<input type="password" name="password">
		<button type="submit" name="submit">Регистрация</button>
	</form>
</body>
</html>