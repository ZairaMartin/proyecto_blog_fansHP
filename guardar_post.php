<?php

if(isset($_POST)){
    //conectamos con la base de datos
    require_once 'includes/conexion.php';


    //recogemos los datos del formulario
    $titulo = mysqli_real_escape_string($inicio_conexion, $_POST['titulo']);
    $contenido = mysqli_real_escape_string($inicio_conexion, $_POST['contenido']);
    $id_categoria = (int)$_POST['categoria'];  //datos del select   casteamos a int para insertarlo sin problema en la base de datos
    $id_usuario = $_SESSION['usuario']['id_usuario'];   //id guardado en los datos de la session en usuario

    //recogemos los errores en un array
    $errores = array();

    //validamos datos
    if(empty($titulo)){
        $errores['titulo'] = "El título del artículo está vacío";
    }
    
    
    if(empty($contenido)){
        $errores['contenido'] = "El contenido del artículo está vacío";
    }
    
    
    if(empty($id_categoria) && !is_numeric($id_categoria)){    
        $errores['categoria'] = "La categoría del artículo no es válida";
    }


        //guardamos la entrada en la base de datos
    if(count($errores) == 0){
        //si le pasamos 'editar' por get edita la entrada, si no la crea e inserta los datos
        if(isset($_GET['editar'])){
            
            $id_usuario = $_SESSION['usuario']['id_usuario'];
            $id_post = $_GET['editar'];
            $id_usuario = $_SESSION['usuario']['id_usuario'];
            //actualizamos el post en la base de datos
            $query_insert = "UPDATE post SET titulo = '$titulo', contenido='$contenido', id_categoria='$id_categoria' WHERE id_post = $id_post AND id_usuario=$id_usuario";
            $guardar_post = mysqli_query($inicio_conexion, $query_insert);

            //cuando la edite el usuario suma 2 puntos y se acumulan en la casa
             //AUMENTAMOS 5 PUNTOS AL AUTOR DEL POST
            $update_puntos = "UPDATE usuarios SET puntos= puntos + 2 WHERE id_usuario = $id_usuario";
            $guardar_puntos = mysqli_query($inicio_conexion, $update_puntos);

            //ACUMULAR LOS PUNTOS EN LA CASA A LA QUE PERTENECE EL USUARIO
            $update_casa = "UPDATE casas SET puntos_totales = puntos_totales + 2 WHERE id_casa = (SELECT id_casa FROM usuarios WHERE id_usuario =$id_usuario)";
            $puntos_totales = mysqli_query($inicio_conexion, $update_casa);


        }else{

            $id_usuario = $_SESSION['usuario']['id_usuario'];
            //insertamos el post en la base de datos
            $query_insert = "INSERT INTO post (`titulo`,`contenido`,`id_usuario`,`id_categoria`,`fecha_publicacion`) VALUES ('$titulo', '$contenido',$id_usuario, $id_categoria , CURDATE())";
            $guardar_post = mysqli_query($inicio_conexion, $query_insert);

            //AUMENTAMOS 5 PUNTOS AL AUTOR DEL POST
            $update_puntos = "UPDATE usuarios SET puntos= puntos + 5 WHERE id_usuario = $id_usuario";
            $guardar_puntos = mysqli_query($inicio_conexion, $update_puntos);

            //ACUMULAR LOS PUNTOS EN LA CASA A LA QUE PERTENECE EL USUARIO
            $update_casa = "UPDATE casas SET puntos_totales = puntos_totales + 5 WHERE id_casa = (SELECT id_casa FROM usuarios WHERE id_usuario =$id_usuario)";
            $puntos_totales = mysqli_query($inicio_conexion, $update_casa);
        }

        //si se guarda correctamente redirigimos al index
        header('Location: index.php');
    }else{
        $_SESSION['errores_entrada'] = $errores;
        if(isset($_GET['editar'])){
            // si hay error editando nos devuelve a la pagina de editar
            header ('Location: editar_entrada.php?id_post='.$_GET['editar']);
        }else{
            //si se produce algun error nos redirige a la misma pagina de crear entradas
            header('Location: crear_entrada.php');
        }
    }
}

    
?>