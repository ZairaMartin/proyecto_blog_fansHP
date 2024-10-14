<?php
    $inicio_conexion = mysqli_connect("localhost", "root", "1234", "blog_harry"); //en el espacio va la contraseña
    if (mysqli_connect_errno()){  //si hay error al conectar
        printf("Conexion con MySQL fallida: %s",mysqli_connect_error());
        exit;
    }else{
       // printf("Conexion MySQL exitosa"."<br>");
    };


    //Iniciar la session
    if(!isset($_SESSION)){  //Si no existe la session, la creamos
        session_start();
    }

?>