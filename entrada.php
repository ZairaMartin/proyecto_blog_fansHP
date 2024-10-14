<?php require_once 'includes/conexion.php'?>
<?php require_once 'includes/funciones.php'?>

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
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/aside.php'; ?>
    <div class="entradas">
        <h1><?=$entrada_actual['titulo']?></h1>
        <h2><?=$nombreCategoria?></h2>
        <h4><?=$entrada_actual['fecha_publicacion']?>  |  <?=$entrada_actual['autor'] ?></h4>
        <p><?=$entrada_actual['contenido']?></p>

        <!-- botones solo disponibles para los autores -->
    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id_usuario'] == $entrada_actual['id_usuario']):?>
        <a href="editar_entrada.php?id_post=<?=$entrada_actual['id_post']?>" class="bttn" >Editar entrada</a>
        <a href="borrar_entrada.php?id_post=<?=$entrada_actual['id_post']?>" class="bttn" >Borrar entrada</a>
        
    <?php endif; ?>
    </div>

<?php  require_once 'includes/footer.php'; ?>