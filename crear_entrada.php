<?php require_once 'includes/redireccion.php'; ?>  <!--  Controlamos si no esta el usuario registrado -->
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/aside.php'; ?>
<!-- <main id="main"> -->
    <div class="post">
        <h1>Crea una nueva entrada</h1>
        <p>Desata la magia en cada palabra y comparte tu hechizo con el mundo. ¡Tu historia es una chispa en el universo de Harry Potter!</p>
        <p>¡Da el paso y publícala!</p>
        <form class="formulario_post" action="guardar_post.php" method="POST">
            <div>
                <label class="form_post" for="titulo">Titulo:</label>
                <input class="input_post" type="text" name="titulo" placeholder="Cuenta tu aventura en el mungo muggles..." >
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'titulo') : '' ?> 
            </div>

            <div>
                <label class="form_post" for="contenido">Contenido:</label>
                <textarea class="input_post" name="contenido" placeholder="Cuenta tu aventura en el mungo muggles..." ></textarea>
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'contenido') : '' ?> 
            </div>

            <div>
                <label class="form_post" for="categoria">Categoria:</label>
                <select class="input_post" name="categoria" require>
                    <option value="2">Personajes</option>
                    <option value="3">Criaturas</option>
                    <option value="4">Hechizos</option>
                    <option value="5">Lugares</option>
                    <option value="1">Otros temas</option>
                </select>
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'categoria') : '' ?> 
            </div>

            <button class="bttn" type="submit">Guardar entrada</button>

        </form>
        <?php  borrarErrores();  ?>
    </div>
<!-- </main> -->
<?php  require_once 'includes/footer.php'; ?>