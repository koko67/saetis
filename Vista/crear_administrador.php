
<?php

session_start();
    include '../Modelo/conexion.php';
    $conectar = new conexion();

//Crear variables--------------------------


$contador = 0;

$addUsuario = $_POST['usuario'];
$addContrasena = $_POST['contrasena'];
$addNombre = $_POST['nombre'];
$addApellido = $_POST['apellido'];
$addTelefono = $_POST['telefono'];
$addEmail= $_POST['email'];




//comprobar si el usuario Existe

$peticion1 =$conectar ->consulta("SELECT * FROM usuario");
$peticion2 = $conectar ->consulta("SELECT * FROM usuario_rol");
$peticion3 = $conectar ->consulta("SELECT * FROM asesor");
	
       /* while($fila = mysql_fetch_array($peticion1))
	{
		if($fila['NOMBRE_U']==$addUsuario)
		{
			$contador++;
		}
		else{}
	}*/
        
    $conect = new conexion();
    $VerificarUsuarioS = $conect->consulta("SELECT LOGIN_S FROM socio WHERE LOGIN_S = '$addUsuario' ");
    $VerificarUsuarioS2 = mysql_fetch_row($VerificarUsuarioS);
    
    
    $VerificarUsuarioGE = $conect->consulta("SELECT NOMBRE_U FROM usuario WHERE NOMBRE_U = '$addUsuario' ");
    $VerificarUsuarioGE2 = mysql_fetch_row($VerificarUsuarioGE);
    
     if (!is_array($VerificarUsuarioS2) && !is_array($VerificarUsuarioGE2)) 
     {
//conexion-------------		
    

	
        
        $peticion1 = $conectar ->consulta("INSERT INTO `saetis`.`usuario` (`NOMBRE_U`, `ESTADO_E`, `PASSWORD_U`, `TELEFONO_U`, `CORREO_ELECTRONICO_U`) VALUES ('$addUsuario', 'Habilitado', '$addContrasena', '$addTelefono', '$addEmail');");
        $peticion2 = $conectar ->consulta("INSERT INTO `saetis`.`usuario_rol` (`NOMBRE_U`, `ROL_R`) VALUES ('$addUsuario', 'administrador');");
        $peticion3 = $conectar ->consulta("INSERT INTO `saetis`.`administrador` (`NOMBRE_U`, `NOMBRES_AD`, `APELLIDOS_AD`) VALUES ('$addUsuario', '$addNombre ', '$addApellido');");
	
         //cerrar conexion--------------------------
	
	 //volver a la pagina---------------
         
    echo"<script type=\"text/javascript\">alert('el registro se realizo exitosamente'); window.location='principal.php';</script>";
	
 }
 else{
     
   echo"<script type=\"text/javascript\">alert('El nombre de usuario ya fue registrado por favor cambie de nombre'); window.location='registro_administrador.php';</script>";  
 }

