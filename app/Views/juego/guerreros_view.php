<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../app/Views/assets/css/css.php') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>Guerreros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1F2326; /* Fondo principal de la paleta */
            color: #8C5C03; /* Texto principal */
        }

        .container {
            background-color: #2A2F33; /* Fondo ligeramente más claro */
            border: 1px solid #734002; /* Borde con color de la paleta */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px #734002; /* Sombra con color de la paleta */
        }

        h1 {
            color: #F2BF27; /* Acento para el título */
            border-bottom: 2px solid #734002; /* Borde inferior */
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .warrior-card {
            flex: 1 1 18%;
            max-width: 18%;
            background-color: #2A2F33; /* Fondo de la tarjeta */
            border: 1px solid #734002; /* Borde con color de la paleta */
            border-radius: 10px;
            box-shadow: 3px 3px 10px #734002; /* Sombra con color de la paleta */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, background-color 0.3s ease-in-out;
            margin: 10px;
        }

        .warrior-card:hover {
            transform: scale(1.05); /* Aumenta el tamaño */
            background-color: #BF8415; /* Fondo para hover */
            box-shadow: 5px 5px 15px #734002; /* Sombra más pronunciada */
        }

        .warrior-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border: 1px solid #734002; /* Borde de la imagen */
            border-radius: 10px 10px 0 0;
            transition: border-color 0.3s;
        }

        .warrior-card:hover img {
            border-color: #F2BF27; /* Acento para hover */
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            color: #F2BF27; /* Acento para el nombre del guerrero */
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .card-text {
            color: #8C5C03; /* Texto principal */
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .card-text strong {
            color: #F2BF27; /* Acento para etiquetas */
        }

        .text-no-warriors {
            color: #F2BF27; /* Acento para mensaje de no guerreros */
            font-size: 1.2rem;
        }

        /* Responsividad para pantallas pequeñas */
        @media (max-width: 768px) {
            .warrior-card {
                flex: 1 1 45%;
                max-width: 45%;
            }
        }

        @media (max-width: 576px) {
            .warrior-card {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
<?php require_once('../app/Views/preload/preload.php'); ?>

<!-- Navbar -->
<?php require_once('../app/Views/nav/navbarJuego.php'); ?>
<!-- End Navbar --> 

<div class="container mt-5">
    <h1 class="text-center">Lista de Guerreros</h1>

    <?php if (!empty($warriors)): ?>
        <?php 
           $raceNames = array_column($races, 'name', 'race_id');
           $typeNames = array_column($types, 'name', 'type_id');
           $chunks = array_chunk($warriors, 5); ?> <!-- Agrupa en filas de 5 guerreros -->

                <?php foreach ($chunks as $group): ?>
                <div class="d-flex flex-wrap justify-content-center mb-4">
                    <?php foreach ($group as $w): ?>
                        <div class="card warrior-card">
                            <?php if (!empty($w['image'])): ?>
                                <img src="<?= base_url('uploads/' . $w['image']) ?>" class="img-thumbnail" alt="<?= esc($w['name']); ?>">
                            <?php else: ?>
                                <p class="text-center text-muted">Sin imagen</p>
                            <?php endif; ?>
                            <div class="card-body">
                                <h3 class="card-title text-center"><?= esc($w['name']); ?></h3>
                                <p class="card-text"><strong>Raza:</strong> <?= esc($raceNames[$w['race_id']] ?? 'Desconocida'); ?></p>
                                <p class="card-text"><strong>Tipo de Guerrero:</strong> <?= esc($typeNames[$w['type_id']] ?? 'Desconocido'); ?></p>
                                <p class="card-text"><strong>Poder:</strong> <?= esc($w['total_power']); ?></p>
                                <p class="card-text"><strong>Magia:</strong> <?= esc($w['total_magic']); ?></p>
                                <p class="card-text"><strong>Vida:</strong> <?= esc($w['health']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-no-warriors">No hay guerreros disponibles.</p>
    <?php endif; ?>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

<footer>
<?php require_once('../app/Views/footer/footerJuego.php'); ?>
</footer>