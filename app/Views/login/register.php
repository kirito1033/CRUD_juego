<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Jugador</title>
    <?php require_once('../app/Views/assets/css/css.php') ?>
</head>
<style>
        body {
            background-color: #1F2326; /* Fondo principal de la paleta */
        }
        .sidebar-logout {
            width: 100%;
            text-align: center;
            background-color: #1F2326; /* Fondo del botón Registrar */
            border: 1px solid #734002; /* Borde con color de la paleta */
            color: #F2BF27; /* Texto con acento */
            margin-top: 10px;
        }

        .sidebar-logout:hover {
          background-color: #F2BF27; /* Acento para hover */
            color: #1F2326;
            border-color: #734002;
        }
        #register-form {
            background-color: #212529; /* Fondo ligeramente más claro */
            border: 1px solid #734002; /* Borde con color de la paleta */
            box-shadow: 0 4px 8px #734002; /* Sombra con color de la paleta */
            padding: 20px;
            width: 350px; /* Mismo ancho que la página de login */
            border-radius: 8px;
        }

        #register-form h2 {
            color: #F2BF27; /* Acento para el título */
        }
        .form-label {
            color: #8C5C03; /* Color de texto para las etiquetas */
        }

        /* Campos de entrada */
        .form-control {
            background-color: #BF8415; /* Fondo de los inputs */
            border: 1px solid #734002; /* Borde con color de la paleta */
            color: #1F2326; /* Texto oscuro para contraste */
        }

        /* Placeholder */
        .form-control::placeholder {
            color: #734002; /* Color del placeholder */
        }

        /* Estado activo (focus) del input */
        .form-control:focus {
            background-color: #F2BF27; /* Acento para input activo */
            border-color: #734002;
            color: #1F2326;
            box-shadow: 0 0 5px #F2BF27;
        }

        .btn-primary {
            background-color: #1F2326; /* Fondo del botón Registrar */
            border: 1px solid #734002; /* Borde con color de la paleta */
            color: #F2BF27; /* Texto con acento */
        }

        .btn-primary:hover {
            background-color: #F2BF27; /* Acento para hover */
            color: #1F2326;
            border-color: #734002;
        }
       .logo-img{
            margin-bottom: 10px;
       }
    </style>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
    
        <form id="register-form" method="POST" action="<?= base_url('/auth/store') ?>">
            <div class="logo-img  d-flex justify-content-center align-items-center">
            <img src="<?= base_url('img/logo.jpeg'); ?>" alt="Logo" height="250">
            </div>
     
        <h2 class="text-center mb-4">Registrar Jugador</h2>
           <div class="mb-3">
                <label for="jugador_name" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="jugador_name" name="jugador_name" required>
            </div>

           <div class="mb-3">
                    <label for="jugador_password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="jugador_password" name="jugador_password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar</button>
             <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger sidebar-logout">Regresar</a>
        </form>
    </div>


</body>
</html>
