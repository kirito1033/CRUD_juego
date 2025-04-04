<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Líderes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php require_once('../app/Views/nav/navbarJuego.php'); ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tabla de Líderes</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Jugador</th>
                        <th>Partidas Ganadas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($players)) : ?>
                        <?php foreach ($players as $player): ?>
                            <tr>
                                <td><?= esc($player['profile_name']) ?></td>
                                <td><?= esc($player['wins']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="2" class="text-center text-danger">No hay datos disponibles</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
   

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
<footer>
<?php require_once('../app/Views/footer/footerJuego.php'); ?>
</footer>
</html>
