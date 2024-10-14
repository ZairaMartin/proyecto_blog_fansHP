<?php require_once 'includes/redireccion.php'; ?>  <!--  Controlamos si no esta el usuario registrado -->
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/aside.php'; ?>
<?php
    $id_post = isset($_GET['id_post']) ? $_GET['id_post'] : null;
    $entrada_actual = conseguirEntrada($inicio_conexion,$id_post);
    if(!isset($entrada_actual['id_post'])){
        header ("Location: index.php");
    }
    //para conseguir el nombre de la categoria
    $sql = "SELECT c.nombre FROM categorias c JOIN post p ON p.id_categoria = c.id_categoria WHERE p.id_post = $id_post";
    $resultado = mysqli_query($inicio_conexion, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $resultadoConsulta = mysqli_fetch_assoc($resultado);
        $nombreCategoria = $resultadoConsulta['nombre'];
    }
?>
    <div class="post">
        <h1>Edita tu entrada <?= $entrada_actual['titulo']?></h1>
        <p>¿Quieres actualizar tus noticias del Diario del profeta? Adelante, la entrada es toda tuya...</p>
        <!-- usamos la misma pagina de guardar entrada pero con un plag ?editar=1 -->
        <form class="formulario_post" action="guardar_post.php?editar=<?= $entrada_actual['id_post']?>" method="POST">
            <div>
                <label class="form_post" for="titulo" >Titulo:</label>
                <input class="input_post" type="text" name="titulo" value="<?=$entrada_actual['titulo'] ?>" >
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'titulo') : '' ?> 
            </div>

            <div>
                <label class="form_post" for="contenido">Contenido:</label>
                <textarea class="input_post" name="contenido" rows="15" ><?=$entrada_actual['contenido'] ?></textarea>
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'contenido') : '' ?> 
                <!-- <?php var_dump($entrada_actual['contenido']);?> -->
            </div>

            <div>
                <label class="form_post" for="categoria">Categoria:</label>
                <select class="input_post" name="categoria" require>
                    <option value="<?= $entrada_actual['id_categoria']?>"><?= $entrada_actual['categoria']?></option>
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

<?php  require_once 'includes/footer.php'; ?>