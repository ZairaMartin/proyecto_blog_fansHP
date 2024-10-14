<?php
//  Esta será mi libreria de funciones
    // alter table x add, drop, modify;
    // isset comprueba si existe la variable y no es null
    // empty comprueba si la variable esta vacia

    function mostrarErrores($errores, $campo){
        $alerta ='';  //por defecto la alerta irá vacía 
        
        if(isset($errores[$campo]) && !empty($errores[$campo])){  //comprobar si dentro de errores existe el $campo  Y si el campo no esta vacio
            $alerta = "<div class='alerta alerta__errores'>".$errores[$campo]."</div>";
        }
        return $alerta;
    }


    // ? BORRAR LOS ERRORES DE LA VARIABLE

    function borrarErrores(){
        $borrado = false;

        // Borro la variable 'errores' de la session
        if(isset($_SESSION['errores'])){
            unset($_SESSION['errores']);
        } 
        
        // Borro la variable 'errores' de la session
        if(isset($_SESSION['errores_entrada'])){
            unset($_SESSION['errores_entrada']);
        } 
        
        if(isset($_SESSION['completado'])){
            unset($_SESSION['completado']);     //booro la variable 'completado' de la session
        }
        
        // comprobamos si la variable ha sido borrada correctamente
        if (!isset($_SESSION['errores'])) {
            $borrado = true;
        }

        return $borrado;
    }

    //  unset elimina todas las variable errores de SESSION, manteniendo la session activa

    //? recoger listado de categorias en el navbar
    function recogerCategorias($inicio_conexion){
        $select_categorias = "SELECT * FROM categorias order by id_categoria";
        $categorias = mysqli_query($inicio_conexion, $select_categorias);
        $resultado = array();

        if($categorias && mysqli_num_rows($categorias) >= 1){
            $resultado = $categorias;
        }
        return $resultado;
    }

    //? para mostrar el nombre de la categoria en la pagina de cada categoria
    function mostrarNombreCategoria($inicio_conexion, $id_categoria){
        $select_categoria = "SELECT nombre FROM categorias WHERE id_categoria = $id_categoria";
        $categoria = mysqli_query($inicio_conexion, $select_categoria);

        $resultado_categoria = array();
        if($categoria && mysqli_num_rows($categoria) >= 1){
            $resultadoCategoria = mysqli_fetch_assoc($categoria);
        }
        return $resultadoCategoria;
    }


    // ?   MOSTRAR ENTRADAS 

    function ultimasEntrada($inicio_conexion){
        $query_entradas = "SELECT p.*, c.nombre AS categoria FROM post p JOIN categorias c ON p.id_categoria=c.id_categoria ORDER BY p.id_post DESC LIMIT 4";
        $entradas = mysqli_query($inicio_conexion, $query_entradas);
        $resultadoEntradas = array();
        if($entradas && mysqli_num_rows($entradas) >= 1){
            $resultado = $entradas;
        }

        return $resultado;
    }

        //? mostrar todas las entradas segun su categoria
    function todasLasEntradasPorCategoria($inicio_conexion, $id_categoria){
        $query_todas_entradas = "SELECT p.*, c.nombre AS categoria FROM post p JOIN categorias c ON p.id_categoria=c.id_categoria WHERE p.id_categoria = $id_categoria ORDER BY p.id_post DESC";
        $todas_entradas = mysqli_query($inicio_conexion,$query_todas_entradas);
        $resultadoTodasEntradas = array();
        if($todas_entradas && mysqli_num_rows($todas_entradas) >= 1){
            $resultadoTodasEntradas = $todas_entradas;
        }
    
        return $resultadoTodasEntradas;
    }
     //? para mostrar todas las entradas resumidas
    function todasLasEntradas($inicio_conexion){
        $query_todas_entradas = "SELECT p.*, c.nombre AS categoria, u.nombre AS 'autor' FROM post p JOIN categorias c ON p.id_categoria=c.id_categoria JOIN usuarios u ON u.id_usuario=p.id_usuario ORDER BY p.id_post DESC";
        $todas_entradas = mysqli_query($inicio_conexion,$query_todas_entradas);
       // $resultadoTodasEntradas = array();
        if($todas_entradas && mysqli_num_rows($todas_entradas) >= 1){
            $todas = $todas_entradas;
        }

        return $todas;
    }
    

    //? funcion para ver la entrada completa 
    function conseguirEntrada($inicio_conexion,$id_post){
        
        if (empty($id_post) || !is_numeric($id_post)) {
            return null; 
        }

        $sql = "SELECT p.*, c.nombre AS 'categoria', u.nombre AS 'autor' FROM post p JOIN categorias c ON p.id_categoria=c.id_categoria JOIN usuarios u ON u.id_usuario=p.id_usuario where p.id_post = $id_post";
        $entradaSola = mysqli_query($inicio_conexion, $sql);
        $resultado_entrada = array();
        if($entradaSola && mysqli_num_rows($entradaSola)>=1){
            $resultado_entrada = mysqli_fetch_assoc($entradaSola);
        }
        return $resultado_entrada;
    }

    function conseguirEntradasUsuario($inicio_conexion, $id_usuario){
        $query_entradas_usuario = "SELECT p.*, c.nombre AS categoria, u.nombre AS autor FROM post p JOIN categorias c ON p.id_categoria = c.id_categoria JOIN usuarios u ON p.id_usuario = u.id_usuario WHERE p.id_usuario = $id_usuario";
        return mysqli_query($inicio_conexion, $query_entradas_usuario);
    }


?>