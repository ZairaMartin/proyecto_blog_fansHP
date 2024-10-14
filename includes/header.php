<?php require_once 'conexion.php'; ?>
<?php require_once 'includes/funciones.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>PotterLandia News</title>
</head>

<body>
    <div class="container">
        <header id="header">
            <div>
                <h2 id="title"> <span class="letra">P</span>otterlandia New´s</h2>
            </div>
            <nav id="nav">
                <ul>
                    <li class="nav__item"><a href="index.php">Inicio</a></li>
                    
                    <li class="nav__item">
                        <a class="pri_letra" href="noticias.php"> Noticias </a>
                    </li>
                    <li class="nav__item">
                        <a class="pri_letra" href="personajes.php"> Personajes </a>
                    </li>
                    <li class="nav__item">
                        <a class="pri_letra" href="criaturas.php"> Criaturas </a>
                    </li>
                    <li class="nav__item">
                        <a class="pri_letra" href="hechizos.php"> Hechizos </a>
                    </li>
                    <li class="nav__item">
                        <a class="pri_letra" href="lugares.php"> Lugares </a>
                    </li>
                    <?php if(isset($_SESSION['usuario'])):?>
                        <li class="nav__item">
                            <a class="pri_letra" href="mis_entradas.php"> Mis entradas </a>
                        </li>
                    <?php endif; ?>
                    

                </ul>
            </nav>
        </header>
        