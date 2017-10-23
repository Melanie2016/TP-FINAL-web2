<?php
    $error1="";
    $error2="";
    $error3="";
    $error4="";
    $error5="";
    if(isset($_POST['btn1']))
    {
		include("abrir_conexion.php");
		$usuario=$_POST['usuario'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];

		$sql="SELECT usuario FROM Empleado WHERE usuario='$usuario' AND '$password' ";
		$result=mysqli_query($conexion,$sql);
		$count=mysqli_num_rows($result); 
		
		
		if(!($usuario==""||$password==""||$password2=="")){
			// validacion usuario 
			if(strlen($usuario)<=5){
				$error1="El usuario debe contener mas de 5 caracteres";
			
				/* es otra manera de comprobar que el usuario no exista en la bd
				if($count>0){  // si arroja un resultado es porque ya existe
					$error="El usuario ya existe, ingrese otro..";
					}
				*/

            }else{
				// validacion contraseña
				if(strlen($password)<=5){
					$error2="La contrase&ntildea debe contener m&aacutes de 5 caracteres";	
				}else{
					if($password != $password2){
						$error3="Las contrase&ntildeas no coinciden";
					}
					else{
						// si todo esta correcto registrar

						// conexion sin objetos: y comprobando que no se repita el usuario 
						if(!$resul=mysqli_query($conexion,"INSERT INTO $tabla_db1 (usuario,password)values('$usuario','$password')"))
						{
							$error4="ERROR! Pruebe ingresando otro usuario";
						}
							// conexion con objeto
							//$conexion->query("INSERT INTO Empleado (usuario,password) values('$usuario','$password')");
				    }
				}
			}
		}
		else{
				$error5="TODOS LOS CAMPOS SON OBLIGATORIOS";

			}
	}
?>

<html>
<head>
  <title>REGISTRAR</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/registro_css.css" rel="stylesheet" type="text/css"> <!-- css general -->
    <link href="css/bootstrap-yeti-theme.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/site.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">

    <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/momentjs-with-locale.js" type="text/javascript"></script>
    <script src="js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="js/site.js" type="text/javascript"></script>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<div class="jumbotron text-center">
  
  <div class="container">
  	<h1 class="form-signin-heading">REGISTRAR</h1>
  	<form class="form-signin" method="POST" action="registro.php"  >

  	<div> <!-- USUARIO -->        
	    <label for="inputUsu" class="sr-only">Usuario </label>
	    <input type="text" name="usuario"  id="inputUsu" class="form-control" placeholder="Usuario" autofocus value=<?php if(isset($usuario))echo $usuario; ?> >
	</div>

	<div> <!-- CLAVE 1 -->
          
	    <label for="inputPassword" class="sr-only">Contrase&ntildea</label>
	    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contrasenia">
	</div>
        
    <div > <!-- CLAVE 2 -->
          
	    <label for="inputPassword" class="sr-only">Confirmar Contrase&ntildea </label>
	    <input type="password" name="password2" id="inputPassword" class="form-control" placeholder="Confirm Password">
	</div>
    <br>
    <input  class="btn btn-lg btn-default btn-block" type="submit" id="btn1" name="btn1" >
            <div class="alert alert-secondary" role="alert">
             <?php
                    echo $error1;
                    echo $error2;
                    echo $error3;
                    echo $error4;
                    echo $error5;
             ?>
        </div>
  </form>

   <center><a href="login.php"> Volver al Login </a> </center>
</body>
</html>