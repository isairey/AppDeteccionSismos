<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Validacion</title>
</head>

<body>
<?php 
	$listaU = listaUser();
	$user = $_REQUEST['user'];
	$pass = $_REQUEST['pass'];
	$ban = 1;
	
	for ($i=0; $i < count($listaU); $i++){
		if($listaU[$i][0] == $user and $listaU[$i][1] == $pass){
			header('Location: registro.php');
			$ban = 0;
		}
	}
	if ($ban == 1){
		header('Location: index.php');
	}
	
	
	
	?>
</body>
</html>


<?php
function listaUser(){
	$file = fopen("datos.txt","r");
	$linea = fgets($file);
	$user = array();
	while($linea != ""){
		array_push($user,explode(",",$linea)) ;
		$linea = fgets($file);
	}
	return($user);
}

?>