        <?php require_once 'includes/header.php'; ?>
        <?php require_once 'includes/aside.php'; ?>
        <!-- <main id="main"> -->
            <div id="principal">
                <section class="intro">
                    <div>
                        <h1>Bienvenidos a <span class="magic">La Madriguera de Potterlandia</span>, ¡el refugio definitivo
                            para todos los amantes del mundo mágico de <span class="magic">Harry Potter</span>!</h1>
                    </div>
                    <div class="carta">
                        <div>
                            <img src="img/index/carta.jpg" alt="imagen de la carta con el sello de Howards">
                        </div>
                        <div class="conversacion">
                            <p class="magic">- After all this time?</p>
                            <p class="magic">- Always.</p>
                        </div>
                    </div>
                    <hr>
                    <article class="conv">
                        <div class="conve">
                            <p>Si te emocionaste al leer esas palabras, si alguna vez esperaste tu carta de Hogwarts, y si
                                conoces la magia del Andén 9¾, has encontrado tu hogar. En este rincón del ciberespacio, la
                                magia nunca se desvanece y los secretos de J.K. Rowling están a solo un clic de distancia.
                            </p>
                        </div>
                    </article>
                    <hr>
                    <h2 class="copas">Clasificación de la Copa de las Casas </h2>
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
                    <hr>
                    <article class="articulo_ind">
                        <h2 class="titulo">¿Qué encontrarás en nuestro Caldero?</h2>
                        <h3 class="subtitulo">Noticias del Profeta Diario</h3>
                        <p class="contenido">Mantente al día con las últimas novedades del Mundo Mágico. Desde los últimos
                            lanzamientos de libros y películas hasta noticias sobre eventos especiales y exposiciones, ¡aquí
                            encontrarás todo lo que necesitas saber!</p>
                    </article>
                    <article class="articulo_ind">
                        <p class="contenido">Únete a nuestra comunidad de hechiceros y brujas, participa en debates
                            apasionados, descubre teorías intrigantes y comparte tu arte mágico con nosotros. ¡Juntos,
                            exploraremos cada rincón de Hogwarts y más allá!</p>
                    </article>
                </section>
                <hr>
                <!-- ! uLTIMAS ENTRADAS --> 
                <section class="ultimas_entradas">
                    <h2 class="tit title_ultimas">Últimas entradas de nuestro Diario Profeta</h2>
                    <?php
                        $entradas = ultimasEntrada($inicio_conexion);
                        if(!empty($entradas)):
                            while($entrada = mysqli_fetch_assoc($entradas)): 
                    ?>
                            <article class="entrada">
                                <a href="entrada.php?id_post=<?=$entrada['id_post']?>">
                                    <h2 class="title__post"> <?= $entrada['titulo'] ?></h2>
                                    <span class="fecha_post"><?= $entrada['categoria'] . ' | ' . $entrada['fecha_publicacion']?> </span>
                                    <p class="descripcion"> <?= substr($entrada['contenido'], 0, 180)."..." ?> </p>
                                    <!-- Para que muestre un fragmento del contenido, desde el caracter 0 hasta el 180 -->
                                </a>
                            </article>

                            
                            <?php
                            endwhile;
                        endif;    
                        ?>
                    <a href="entradas.php" class="bttn" >Ver todas las entradas</a>
                    
                </section>
            </div>
        <!-- </main> -->
    
        
    <?php  require_once 'includes/footer.php'; ?>