
<?php
    require_once 'includes/conexion.php';
    
    if(isset($_SESSION['usuario']) && isset($_GET['id_post'])){
        $id_post = $_GET['id_post'];
        $id_usuario = $_SESSION['usuario']['id_usuario'];
        $delete_query = "DELETE FROM post WHERE id_usuario=$id_usuario AND id_post=$id_post"; 
        mysqli_query($inicio_conexion, $delete_query);

        //quitamos 2 puntos al usuario que elimine un post
        $update_puntos = "UPDATE usuarios SET puntos= puntos - 2 WHERE id_usuario = $id_usuario";
        $guardar_puntos = mysqli_query($inicio_conexion, $update_puntos);
        //quitamos los puntos tambien de los acumulados en la casa
        $update_casa = "UPDATE casas SET puntos_totales = puntos_totales - 2 WHERE id_casa = (SELECT id_casa FROM usuarios WHERE id_usuario =$id_usuario)";
        $puntos_totales = mysqli_query($inicio_conexion, $update_casa);
    }

    header("Location: index.php");


?>