<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        body {
            background-color: #1F2326 !important; /* Fondo principal de la paleta */
        }

        .card {
            background-color: #212529; /* Fondo ligeramente más claro */
            border: 1px solid #734002; /* Borde con color de la paleta */
            box-shadow: 0 4px 8px #734002; /* Sombra con color de la paleta */
        }

        .card h2 {
            color: #F2BF27; /* Acento para el título */
        }

        .form-label {
            color: #8C5C03; /* Texto de etiquetas */
        }

        .form-control {
            background-color: #BF8415; /* Fondo de los inputs */
            border: 1px solid #734002; /* Borde con color de la paleta */
            color: #1F2326; /* Texto oscuro para contraste */
        }

        .form-control::placeholder {
            color: #734002; /* Placeholder con color de la paleta */
        }

        .form-control:focus {
            background-color: #F2BF27; /* Acento para input activo */
            border-color: #734002;
            color: #1F2326;
            box-shadow: 0 0 5px #F2BF27;
        }

        .btn-primary {
            background-color: #1F2326; /* Fondo del botón Ingresar */
            border: 1px solid #734002; /* Borde con color de la paleta */
            color: #F2BF27; /* Texto con acento */
        }

        .btn-primary:hover {
            background-color: #F2BF27; /* Acento para hover */
            color: #1F2326;
            border-color: #734002;
        }

        .btn-secondary {
            background-color: #BF8415; /* Fondo del botón Registrar */
            border: 1px solid #734002; /* Borde con color de la paleta */
            color: #1F2326; /* Texto oscuro para contraste */
        }

        .btn-secondary:hover {
            background-color: #F2BF27; /* Acento para hover */
            color: #1F2326;
            border-color: #734002;
        }

        .alert-success {
            background-color: #BF8415; /* Fondo para alerta de éxito */
            color: #1F2326; /* Texto oscuro para contraste */
            border: 1px solid #734002;
        }

        .alert-danger {
            background-color: #734002; /* Fondo para alerta de error */
            color: #F2BF27; /* Texto con acento */
            border: 1px solid #734002;
        }
    </style>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 350px;">
        <img src="<?= base_url('img/logo.jpeg'); ?>" alt="Logo" height="250">
        <h2 class="text-center mb-4">Login</h2>
        <?php if(session()->getFlashdata('token')): ?>
            <div class="alert alert-success">
                <strong>Token:</strong> <?= session()->getFlashdata('token') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->get('alert_message')): ?>
            <script type="text/javascript">
                alert("<?php echo session()->get('alert_message'); ?>");
            </script>
            <?php session()->remove('alert_message'); ?>
        <?php endif; ?>
        <form action="<?= site_url('auth/login') ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
          
        </form>
        

        <a href="<?= base_url('/auth/register') ?>" class="btn btn-secondary mt-3">Registrar Jugador</a>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger p-2 m-3 text-center">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
    </div>
  
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
