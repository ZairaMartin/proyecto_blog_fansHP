<?php require_once 'includes/conexion.php'; ?>

    <aside id="aside">
        <!--   Estructura de control para insertar codigo php en una vista con html -->
        <div>
            <?php if(isset($_SESSION['usuario'])):  ?> <!-- Si exsite variable de session con el usuario regsitrado-->
                <div class="formulario login">
                    <div class="session">
                        <h3>Bienvenido al caldero, <?= $_SESSION['usuario']['nombre'] ?></h3>
                    </div>
                    <!-- cerrar session -->
                    <div class="botones">
                        <a href="datos_usuario.php" class="bttn" >Mis datos</a>
                        <a href="crear_entrada.php" class="bttn" >Crear entrada</a>
                        <a href="cerrar_session.php" class="bttn" >Cerrar sesión</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if(!isset($_SESSION['usuario'])):  ?>
            <div id="login">
                <form class="formulario" action="login.php" method="POST">
                    <fieldset>
                        <legend>Identifícate: </legend>

                        <?php if(isset($_SESSION['error_login'])):  ?> <!-- Si exsite variable de session de error login-->
                            <div class="alerta alerta__errores">
                                <?= $_SESSION['error_login'] ?>
                            </div>
                        <?php endif; ?>

                        <div class="form">
                            <label class="form__item"  for="email">Email o lechuza: </label>
                            <input type="email" name="email" placeholder="Email">
                        </div>

                        <div class="form">
                            <label class="form__item"  for="password">Contraseña: </label>
                            <input class="margen__botton" type="password" name="password" placeholder="Contraseña">
                        </div>
                        
                        <button id="bttn_login" type="submit">Login</button>

                    </fieldset>
                </form>
            </div>
        
            <div id="registro">
                <form id="form_registro" class="formulario" action="registro.php" method="POST">
                    <fieldset>
                        <legend>Registrate: </legend>
                        <?php if(isset($_SESSION['completado'])) : ?>   <!-- mostrar exito de registro -->
                            <div class="alerta alerta__exito"> <?= $_SESSION['completado'] ?> </div>
                        <?php elseif(isset($_SESSION['errores']['general'])): ?>       <!-- mostrar errores -->
                            <div class="alerta alerta__errores"> <?= $_SESSION['errores']['general'] ?> </div>
                        <?php endif; ?>
                        <div class="form">
                            <label class="form__item" for="nombre">Nombre de usuario: </label>
                            <input type="text" name="nombre" placeholder="Nombre" required>
                        </div>
                            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : '' ?> 
                            <!-- Esta funcion accede al array de errores guardados en session y en el indice de nombre -->
                            <!--TERNARIA si existe errores ? muestra los errores : si no no hace nada '' -->

                        <div class="form">
                            <label class="form__item" for="email">Email o lechuza: </label>
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : '' ?>
                        <div class="form">
                            <label class="form__item" for="password">Contraseña anti-muggles: </label>
                            <input type="password" name="password" placeholder="Contraseña" required>
                        </div>
                            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : '' ?>
                        
                        <div class="form">
                            <label class="form__item" for="email">Escoge una casa de Howarts: </label>
                            <select name="casa" id="casa" required>
                                <option value="1">Gryffindor</option>
                                <option value="2">Slytherin</option>
                                <option value="3">Hufflepuff</option>
                                <option value="4">Ravenclaw</option>
                            </select>
                        </div>
                        <button id="bttn_registro" type="submit">Registrar</button>
                    </fieldset>
                </form>
                <?php borrarErrores();  ?>
            </div>
        <?php endif; ?>
        
    </aside>
    <main id="main">