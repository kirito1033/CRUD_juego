<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Partida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container">
    <h2 class="text-center">Crear Nueva Partida</h2>
    <form id="gameForm" action="<?= base_url('partidas/store'); ?>" method="POST">
        <div class="mb-3">
            <label for="game_name" class="form-label">Nombre de la Partida</label>
            <input type="text" class="form-control" id="game_name" name="game_name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Modo de Juego</label>
            <input type="text" class="form-control" value="1vs1" readonly>
            <input type="hidden" name="game_mode" value="1vs1">
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">Duración (minutos)</label>
            <input type="number" class="form-control" id="duration" name="duration" min="5" max="60" required>
        </div>

        <div class="mb-3">
            <label for="win_condition" class="form-label">Condición de Victoria</label>
            <select class="form-select" id="win_condition" name="win_condition" required>
                <option value="poder">Por Poder</option>
                <option value="magia">Por Magia</option>
                <option value="suma">Suma de Poder y Magia</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="player_life" class="form-label">Vida Inicial del Jugador</label>
            <input type="number" class="form-control" id="player_life" name="player_life" min="100" max="10000" value="300" required>
        </div>

        <div class="mb-3">
            <input type="checkbox" id="password_enabled" name="password_enabled">
            <label for="password_enabled">Habilitar contraseña</label>
        </div>

        <div class="mb-3" id="password_field" style="display: none;">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select class="form-select" id="status" name="status">
                <option value="publica">Pública</option>
                <option value="privada">Privada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Crear Partida</button>
    </form>
</div>

<!-- Sección de partidas disponibles -->
<div class="container mt-5">
    <h2 class="text-center">Partidas Disponibles</h2>
    
    <table class="table table-dark table-striped mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Modo</th>
                <th>Duración</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidas as $partida): ?>
                <tr>
                    <td><?= esc($partida['game_name']) ?></td>
                    <td><?= esc($partida['game_mode']) ?></td>
                    <td><?= esc($partida['duration']) ?> min</td>
                    <td><?= esc($partida['status']) ?></td>
                    <td>
                        <a href="<?= base_url('partidas/unirse/' . $partida['id']) ?>" class="btn btn-success">Unirse</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('password_enabled').addEventListener('change', function() {
        document.getElementById('password_field').style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById('gameForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        let formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "<?= base_url('partidas/mostrarUltimaPartida/'); ?>" + data.id;
            } else {
                alert('Hubo un error al crear la partida: ' + data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
<?php require_once('../app/Views/footer/footer.php'); ?>
</body>
</html>
