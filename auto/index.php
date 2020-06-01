<?
$dbc = mysqli_connect('localhost', 'root', 'root', 'test'); //Подключение к БД 
if(!isset($_COOKIE['id'])){
	if(isset($_POST['submit'])){
		$user_login = mysqli_real_escape_string($dbc, trim($_POST['login']));
		$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		if(!empty($user_login) && !empty($user_password)){
			$query = "SELECT `id`, `login` FROM `signup` WHERE login = '$user_login' AND password = '$user_password'";
			$data = mysqli_query($dbc,$query);
			//Добавляем куки
			if(mysqli_num_rows($data) == 1){
				$row = mysqli_fetch_assoc($data);
				setcookie('id', $row['id'], time() + (60*60*24*15));
				setcookie('login', $row['login'], time() + (60*60*24*15));
				$home_url = 'http://' . $_SERVER['HTTP_HOST'];
				header('Location: '.$home_url);
			}
			else{
				echo 'Ввели неверно логин или пароль';
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Главная</title>
</head>
<body>
	<?
	if(empty($_COOKIE['login'])){
	?>
	<form method="POST" action="<? echo $_SERVER['PHP_SELF']; ?>">
		<label for="login">Логин:</label>
		<input type="text" name="login">
		<label for="password">Пароль:</label>
		<input type="password" name="password">
		<button type="submit" name="submit">Войти</button>
		<a href="signup.php">У вас нет аккаунта?</a>
	</form>
	<?
	}
	else{
		?>
		<p><a href="myprofile.php">Мой профиль</a></p>
		<p><a href="exit.php">Выйти</a></p>
	<?
	}
	?>
</body>
</html>