<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<script>
function myFunction() {
    alert("Hello\nHow are you?");
}
</script>
<form method="post" action="log.php" id="login">
	<center><h1> Iniciar Sesión </h1>
    <p> Nombre de usuario: </p>
	<input type="text" name="user"  placeholder="Usuario.." required > 
    <p> Contraseña: </p>
	<input type="password" name="pass"  placeholder="Contraseña.." required > <br><br>
		<input id="log" type="submit" value="Iniciar Sesión"><br><br></center>

</form>
</body>
</html>