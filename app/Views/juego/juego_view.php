<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../app/Views/assets/css/css.php') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>Juego</title>
    <style>
        /* Hace que el body ocupe toda la altura de la pantalla */
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #121517;
        }
        .boton-animado {
            display: inline-block;
            border: 2px solid #734002; /* Borde con color de la paleta */
            border-radius: 10px;
            box-shadow: 4px 4px 10px #734002; /* Sombra con color de la paleta */
            padding: 10px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, background-color 0.3s ease-in-out;
            text-decoration: none;
            background-color: #BF8415; /* Fondo del botón */
        }
          /* Animación al hacer hover */
        .boton-animado:hover {
            transform: translateY(-5px);
            box-shadow: 6px 6px 15px #734002; /* Sombra más pronunciada */
            background-color: #F2BF27; /* Acento para hover */
        }

        /* Estilos para el texto dentro de los botones */
        .boton-animado h4 {
            color: #F2BF27; /* Texto con acento */
            margin-top: 10px;
        }

        .boton-animado:hover h4 {
            color: #1F2326; /* Contraste para hover */
        }

        /* Estilos para las imágenes */
        .boton-animado img {
            width: 300px;
            height: auto;
            border: 1px solid #734002; /* Borde sutil */
            border-radius: 5px;
        }
        /* Asegura que el contenido principal crezca y empuje el footer hacia abajo */
        .container {
            flex-grow: 1;
            margin-bottom: 20px;
        }

        /* Espacio adicional para el footer */
        footer {
            margin-top: auto;
        }

       
    </style>
</head>

<body>
    
    <?php require_once('../app/Views/preload/preload.php'); ?>

    <!-- Navbar -->
    <?php require_once('../app/Views/nav/navbarJuego.php'); ?>
    <!-- End Navbar -->

    <!-- Container -->
    <div class="d-flex justify-content-center gap-4 mt-5">
        <a href="<?= base_url('juego/guerreros'); ?>" class="boton-animado">
            <div class="d-flex flex-column align-items-center">
                <img src="<?= base_url('img/ver_guerreros.jpng'); ?>" alt="Ver Guerreros" class="img-fluid" style="width: 300px; height: auto;">
                <h4 class="mt-2 text-dark">Ver Guerreros</h4>
            </div>
        </a>
        <a href="<?= base_url('juego/crear'); ?>" class="boton-animado">
            <div class="d-flex flex-column align-items-center">
                <img src="<?= base_url('img/crear_partida.jpg'); ?>" alt="Ver Partida" class="img-fluid" style="width: 300px; height: auto;">
                <h4 class="mt-2 text-dark">Ver Partidas </h4>
            </div>
        </a>
    </div>

    <!-- End Container -->    
    <!-- Footer -->
    
    <!-- Scripts -->
    <?php require_once('../app/Views/assets/js/js.php') ?>
    <?php require_once('../app/Views/assets/js/dataTable.php') ?>

</body>

<footer>
<?php require_once('../app/Views/footer/footerJuego.php'); ?>
</footer>

</html>


