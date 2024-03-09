<?php

if (!isset($_SESSION)) { //REVISA
  session_start(); //CON ESTE IF SI LA SESION NO ESTA INICIADA SE INICIA (PARA QUE NO SEA DOBLE)
}
$auth = $_SESSION["login"] ?? false;

if (!isset($inicio)) {
  $inicio = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienes Raices</title>
  <link rel="icon" href="/build/img/icons8-bienes-raíces-64.png" type="image/x-icon">
  <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>

  <header class="header <?php echo $inicio ? "inicio" : ""; ?> ">
    <div class="contenedor contenido-header">
      <div class="barra">
        <a href="/">
          <img src="../../build/img/logo.svg" alt="Logotipo de bienes raices">
        </a>
        <div class="mobile-menu">
          <img src="../../build/img/barras.svg" alt="Icono menu responsive">
        </div>

        <div class="derecha">
          <img src="../../build/img/dark-mode.svg" alt="Boton dark mode" class="dark-mode-boton">
          <nav class="navegacion">
            <a href="/nosotros">Nosotros</a>
            <a href="/propiedades">Propiedades</a>
            <a href="/blog">Blog</a>
            <a href="/contacto">Contacto</a>
            <?php if ($auth) : ?>
              <a href="cerrar-sesion.php">Cerrar Sesion</a>
            <?php endif; ?>
          </nav>
        </div>


      </div> <!--.barra-->

      <?php echo $inicio ? "<h1>Venta de Casas y Departanentos Exclusivos de Lujo </h1>" : ""; ?>

    </div>
  </header>
  <?php echo $contenido ?>
  <footer class="footer seccion">
    <div class="contenedor contenedor-footer">

      <nav class="navegacion">
        <a href="/nosotros">Nosotros</a>
        <a href="/propiedades">Propiedades</a>
        <a href="/blog">Blog</a>
        <a href="/contacto">Contacto</a>
      </nav>

      <p class="copyright">Todos los derechos reservados <?php echo date("Y"); ?> &copy; - Javier Vivas Ávila</p>
    </div>
  </footer>


  <script src="../build/js/bundle.min.js"></script>
</body>

</html>