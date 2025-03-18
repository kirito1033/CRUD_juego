<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Jugador</title>
    <?php require_once('../app/Views/assets/css/css.php') ?>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
    
        <form id="register-form" method="POST" action="<?= base_url('/auth/store') ?>">
        <h2 class="text-center mb-4">Registrar Jugador</h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control " id="jugador_name" name="jugador_name" placeholder="Name" required>
                <label for="jugador_name">Usuario</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="jugador_password" name="jugador_password" placeholder="Password" required>
                <label for="jugador_password">Contraseña</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>
    </div>


</body>
</html>
