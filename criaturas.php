<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/aside.php'; ?>
<div class="entradas">
    <h1 class="tit">Criaturas</h1>
    <?php
        $id_categoria = 3; 
        $entradas = todasLasEntradasPorCategoria($inicio_conexion, $id_categoria);
        if(!empty($entradas)):
            while($entrada = mysqli_fetch_assoc($entradas)): 
        ?>
        <article class="entrada">
            <a href="entrada.php?id_post=<?=$entrada['id_post']?>">
                <h2 class="title__post"> <?= $entrada['titulo'] ?></h2>
                <span class="fecha_post"><?= $entrada['categoria'] . ' | ' . $entrada['fecha_publicacion']?></span>
                <p class="descripcion"> <?= substr($entrada['contenido'], 0, 180)."..." ?> </p>
            </a>
        </article>
        <hr>
    <?php
            endwhile;
        endif;
    ?>
</div>

<?php require_once 'includes/footer.php'; ?>
