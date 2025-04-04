<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 350px;">
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
