<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Perfil</title>
    <?php require_once('../app/Views/assets/css/css.php') ?>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
    
        <form id="register-form" method="POST" action="<?= base_url('/auth/store2') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <h2 class="text-center mb-4">Registrar Perfil</h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control " id="profile_email" name="profile_email" placeholder="Email" required>
                <label for="profile_email">Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="profile_name" name="profile_name" placeholder="Name" required>
                <label for="profile_name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" class="form-control" id="profile_photo" name="profile_photo" placeholder="Photo" required>
                <label for="profile_photo">Photo</label>
            </div>
            <div class="form-floating mb-3">
            <input type="hidden" id="jugador_id_fk" name="jugador_id_fk" 
                 value="<?= session()->get('jugador_id_fk') ?>">
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar Perfil</button>
        </form>
    </div>
</body>
</html>

<script>
   document.getElementById('register-form').addEventListener('submit', function(event) {
    console.log("Formulario enviado"); // 🔍 Depuración
});
</script>