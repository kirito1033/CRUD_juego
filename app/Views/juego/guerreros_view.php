<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../app/Views/assets/css/css.php') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>Guerreros</title>
    
    <style>
        .warrior-card {
            flex: 1 1 18%;
            max-width: 18%;
            transition: transform 0.3s ease-in-out;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3); /* Sombra suave */
            border-radius: 10px; /* Bordes redondeados */
        }

        .warrior-card:hover {
            transform: scale(1.05); /* Aumenta el tamaño ligeramente al pasar el mouse */
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
                    <div class="card bg-dark text-light m-2 warrior-card">
                        <?php if (!empty($w['image'])): ?>
                            <img src="<?= base_url($w['image']) ?>" class="img-thumbnail" width="100%" height="200" alt="<?= esc($w['name']); ?>">
                        <?php else: ?>
                            <p class="text-center text-warning">No image</p>
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
        <p class="text-center text-warning">No hay guerreros disponibles.</p>
    <?php endif; ?>
</div>

<!-- Incluir Bootstrap si aún no lo tienes -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

<footer>
<?php require_once('../app/Views/footer/footerJuego.php'); ?>
</footer>
