<?php require_once 'includes/redireccion.php'; ?>  <!--  Controlamos si no esta el usuario registrado -->
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/aside.php'; ?>
<div class="mis_datos">
        <h1>Mis datos: </h1>
        <div>
            <p>Mi nombre es <?php echo $_SESSION['usuario']['nombre'] ?></p>
            <p>Estoy registrado con el correo: </p>
            <p><?php echo $_SESSION['usuario']['email'] ?></p>

        <?php  if(isset($_SESSION['usuario']['id_casa'])){
                        $id_casa = $_SESSION['usuario']['id_casa'];
                        $casa_usuario = "select nombre_casa from casas where id_casa = $id_casa ";
                        $resultado = mysqli_query($inicio_conexion, $casa_usuario);                    
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            $casa_usuario = mysqli_fetch_assoc($resultado);
                            $nombre_casa = $casa_usuario['nombre_casa'];
                        } else {
                            $nombre_casa = "Desconocida";
                        }
                    }else{
                        $nombre_casa="Desconocida";
                    }
            // Para buscar el numero de netradas que tiene publicadas este usuario
                    if(isset($_SESSION['usuario'])){
                        $id_usuario = $_SESSION['usuario']['id_usuario'];
                        $entradas = "SELECT count(id_post) as numero from post where id_usuario = $id_usuario";
                        $resultado_post = mysqli_query($inicio_conexion, $entradas);
                        if ($resultado_post && mysqli_num_rows($resultado_post) > 0) {
                            $entradas = mysqli_fetch_assoc($resultado_post);
                            $num_entradas = $entradas['numero'];
                            //var_dump($entradas);
                        } else {
                            $num_entradas = 0;
                        }
                    }

            // para buscar sus puntos totales
                    if(isset($_SESSION['usuario'])){
                        $id_usuario = $_SESSION['usuario']['id_usuario'];
                        $query_puntos = "SELECT puntos FROM usuarios WHERE id_usuario=$id_usuario";
                        $resultado_puntos = mysqli_query($inicio_conexion, $query_puntos);
                        if ($resultado_puntos && mysqli_num_rows($resultado_puntos) > 0) {
                            $puntos_regogidos = mysqli_fetch_assoc($resultado_puntos);
                            $puntos = $puntos_regogidos['puntos'];
                        } else {
                            $puntos = 0;
                        }
                        //var_dump($id_usuario);
                        // var_dump($id_usuario);
                       // var_dump($puntos_regogidos);
                    }
                    
            ?>
            <p>Pertenezco a la casa de <?=$nombre_casa; ?></p>
            <p>He publicado  <?=$num_entradas;?>   entradas en este blog.</p>
            <p>He conseguido <?=$puntos;?>  puntos para... ¡<?=$nombre_casa; ?>!</p>

        </div>
        <br>
        <div class="espacio">
        <?php
                        require_once 'includes/conexion.php';
                        
                        //mostramos los puntos de Gryffindor
                        $select_query_puntos_G = "Select puntos_totales FROM casas WHERE id_casa=1";
                        $resultado_g = mysqli_query($inicio_conexion, $select_query_puntos_G); // recoge el contenido de la consulta
                        $puntos_g = mysqli_fetch_assoc($resultado_g)['puntos_totales']; 
                
                        //mostramos los puntos totales de Slytherin
                        $select_query_puntos_S = "Select puntos_totales FROM casas WHERE id_casa=2";
                        $resultado_s = mysqli_query($inicio_conexion, $select_query_puntos_S);
                        $puntos_s = mysqli_fetch_assoc($resultado_s)['puntos_totales'];
                
                        //mostramos los puntos totales de Hufflepuff
                        $select_query_puntos_H = "Select puntos_totales FROM casas WHERE id_casa=3";
                        $resultado_h = mysqli_query($inicio_conexion, $select_query_puntos_H);
                        $puntos_h = mysqli_fetch_assoc($resultado_h)['puntos_totales'];
                
                        //mostramos los puntos totales de Ravenclaw
                        $select_query_puntos_R = "Select puntos_totales FROM casas WHERE id_casa=4";
                        $resultado_r = mysqli_query($inicio_conexion, $select_query_puntos_R);
                        $puntos_r = mysqli_fetch_assoc($resultado_r)['puntos_totales'];
                
                
                        
                        echo '<div id="competicion">';
                            echo ' <div  class="compet G">';
                                echo '<h3>Gryffindor</h3>';
                                echo '<h4 class="puntos">' . $puntos_g . '</h4>';
                            echo '</div>';
                            echo '<div  class="compet S">';
                                echo '<h3>Slytherin</h3>';
                                echo '<h4 class="puntos">' . $puntos_s . '</h4>';
                            echo '</div>';
                            echo '<div  class="compet H">';
                                echo '<h3>Hufflepuff</h3>';
                                echo '<h4 class="puntos">' . $puntos_h . '</h4>';
                            echo '</div>';
                            echo '<div  class="compet R">';
                                echo '<h3>Ravenclaw</h3>';
                                echo '<h4 class="puntos">' . $puntos_r . '</h4>';
                            echo '</div>';
                        echo '</div>';
                        ?>
        </div>


</div>
            <!-- Para buscar el nombre de la casa a la qeu corresponde el usuario -->
            
<?php  require_once 'includes/footer.php'; ?>