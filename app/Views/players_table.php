<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Líderes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        body {
            background-color: #1F2326; /* Fondo principal de la paleta */
            color: #8C5C03; /* Texto principal */
        }

        .container {
            margin-top: 50px;
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

        .table {
            background-color: #1F2326; /* Fondo de la tabla */
            color: #8C5C03; /* Texto principal */
            border: 1px solid #734002; /* Borde con color de la paleta */
        }

        .table thead th {
            background-color: #1F2326; /* Fondo de encabezados */
            color: #F2BF27; /* Acento para texto */
            border: 1px solid #734002; /* Bordes */
            text-align: center;
        }

        .table tbody tr {
            background-color: #2A2F33; /* Fondo de filas */
            transition: background-color 0.3s;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #3A3F44; /* Alternancia para efecto de rayas */
        }

        .table tbody tr:hover {
            background-color: #BF8415; /* Fondo para hover */
        }

        .table td {
            border: 1px solid #734002; /* Bordes de celdas */
            color: #8C5C03; /* Texto principal */
            vertical-align: middle;
        }

        .text-no-data {
            color: #F2BF27; /* Acento para mensaje de no datos */
            font-size: 1.2rem;
        }

        /* Responsividad */
        @media (max-width: 576px) {
            .table {
                font-size: 0.9rem;
            }

            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
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
