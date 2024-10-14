<?php

    if(!isset($_SESSION)){  //Si no existe la session, la creamos
        session_start();
    }

    if(!isset($_SESSION['usuario'])){  //si no hay usuario identificado
        header('Location: index.php');  // redirigimos al index para que se registre y logue
    }

?>