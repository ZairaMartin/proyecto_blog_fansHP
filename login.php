<?php  
    require_once 'includes/conexion.php';


    if(isset($_POST)){

        //borrar error de sesion anterior
        if(isset($_SESSION['error_login'])){
            unset($_SESSION['error_login']);
        }

        //recogemos datos de la nueva session
        $email = trim($_POST['email']);
        $passw = $_POST['password'];

        
        //comprobamos si hay registro con ese email
        $select_query = "Select * FROM usuarios WHERE email='$email'";
        $resultado_query = mysqli_query($inicio_conexion, $select_query);


        if($resultado_query && mysqli_num_rows($resultado_query)==1){   //si login da true y el numero de filas es 1
            // fetch_assoc nos saca un array asociativo con el contenido de la consulta
            $usuario = mysqli_fetch_assoc($resultado_query);
            //var_dump($usuario);
            //die();
            $verificarPassword = password_verify($passw , $usuario['password']);  //esta funcion nos compara la contraseña introducida con la que tenemos guardada en la base de datos
            
            if($verificarPassword){    
                //guardamos los tados del usuario en la session
                $_SESSION['usuario'] = $usuario;

                

            }else{
                $_SESSION['error_login'] = "El email o la contraseña son incorrectos.";
            }
        }else{
            $_SESSION['error_login'] = "El email o la contraseña son incorrectos.";
        }
    }

    //REDIRIGIMOS AL INDEX
    header('Location: index.php');


?>