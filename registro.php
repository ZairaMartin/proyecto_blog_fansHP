<?php
    if(isset($_POST)){
        //meto la conexion a la base de datos dentro para que acceda si verdaderamente han hecho post del usuario
        require_once 'includes/conexion.php';
        if(!isset($_SESSION)){    //si no existe session la inicializamos
            session_start();
        }
        
        //operacion ternaria recogiendo los valores del formulario de registro

        $nombre =isset($_POST['nombre']) ? $_POST['nombre'] : false ;
        $email =isset($_POST['email']) ? trim($_POST['email']) : false ;
        $passw =isset($_POST['password']) ? $_POST['password'] : false ;
        $casa =isset($_POST['casa']) ? $_POST['casa'] : false ;
        

        //array de errores del formulario
        $errores = [];  

        //comprobacion para nombre
        if(!empty($nombre) && !is_numeric($nombre) && preg_match('/^[a-zA-Z\s]+$/', $nombre)){  //comprueba que el nombre no esta vacio, que no son numeros y que son letras 
            //el nombre es válido
        }else{
            $errores['nombre'] = "El nombre no es válido";
        }
        
        //comprobacion para EMAIL
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            //el nombre es válido
        }else{
            $errores['email'] = "El email no es válido";
        }
        
        //comprobacion para CONTRASEÑA
        if (empty($passw)) {  //si la contraseña ESTÁ vacia
            $errores['password'] = "La contraseña está vacía.";
        } elseif (strlen($passw) < 6) {
            $errores['password'] = "La contraseña debe tener al menos 6 caracteres.";
        }


        // comprobar si el email ya esta registrado en la base de datos
        $select_query_email = "Select * FROM usuarios WHERE email='$email'";
        $resultado_query_email = mysqli_query($inicio_conexion, $select_query_email);

        if(mysqli_num_rows($resultado_query_email) > 0){
            $errores['email'] = "El email introducido ya está registrado";
        }

        //devuelvo todo el listado de errores
        var_dump($errores);

        $guardar_usuario = false;
        //si no hay ningun error hacemos el insetr y registramos el usuario

        if(empty($errores)){

            $guardar_usuario = true;

            //CIFRAR LA CONTRASEÑA          contraseña, tipo de cifrado, veces que se cifra
            $password_cifrada = password_hash($passw, PASSWORD_BCRYPT,['cost' => 4]);

            $insert_usuario = "INSERT INTO usuarios(`nombre`,`email`,`password`,`id_casa`) VALUES ('$nombre', '$email', '$password_cifrada', '$casa')";
            mysqli_query($inicio_conexion, $insert_usuario); 
        
            
            if($guardar_usuario){
                $_SESSION['completado'] = "El registro se ha completado con éxito.";

                
            }else{
                $_SESSION['errores']['general'] = 'Fallo al guardar el usuario'; 
            }

        
            header('Location: index.php');
        
        }else{  //si hay errores regirigimos 
            $_SESSION['errores'] = $errores;
            
            //redirigimos al index 
            header('Location: index.php');
            //exit();
        }

    

    }


?>