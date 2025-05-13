<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Partida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
        body {
            background-color: #1F2326; /* Fondo principal de la paleta */
            color: #8C5C03; /* Texto principal */
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: #2A2F33; /* Fondo ligeramente más claro */
            border: 1px solid #734002; /* Borde con color de la paleta */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px #734002; /* Sombra con color de la paleta */
        }

        h2 {
            color: #F2BF27; /* Acento para el título */
            border-bottom: 2px solid #734002; /* Borde inferior */
            padding-bottom: 10px;
            margin-bottom: 20px;
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
        }

        .table tbody tr {
            background-color: #2A2F33; /* Fondo de filas */
            transition: background-color 0.3s;
        }

        .table tbody tr:hover {
            background-color: #BF8415; /* Fondo para hover */
        }

        .table td {
            border: 1px solid #734002; /* Bordes de celdas */
            color: #8C5C03; /* Texto principal */
            vertical-align: middle;
        }

        .countdown-timer {
            color: #F2BF27; /* Acento para temporizador */
        }

        .countdown-timer.text-danger {
            color: #734002; /* Color para "Expirada" */
        }

        .unirse-btn {
            background-color: #1F2326; /* Fondo del botón Unirse */
            color: #F2BF27; /* Texto con acento */
            border: 1px solid #734002; /* Borde con color de la paleta */
            border-radius: 5px;
            padding: 5px 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        .unirse-btn:hover {
            background-color: #F2BF27; /* Acento para hover */
            color: #1F2326; /* Contraste para texto */
        }

        .unirse-btn.btn-danger {
            background-color: #734002; /* Fondo para Expirada */
            color: #F2BF27; /* Texto con acento */
            border: 1px solid #734002; /* Borde */
        }

        .modal-content {
            background-color: #2A2F33; /* Fondo del modal */
            border: 1px solid #734002; /* Borde con color de la paleta */
            border-radius: 10px;
        }

        .modal-header {
            background-color: #1F2326; /* Fondo del encabezado */
            border-bottom: 1px solid #734002; /* Borde inferior */
        }

        .modal-title {
            color: #F2BF27; /* Acento para el título */
        }

        .btn-close {
            filter: invert(1) sepia(1) saturate(5) hue-rotate(180deg); /* Ícono blanco ajustado */
        }

        .modal-body {
            color: #8C5C03; /* Texto principal */
        }

        .form-label {
            color: #8C5C03; /* Texto de etiquetas */
        }

        .form-control {
            background-color: #BF8415; /* Fondo del input */
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

        .modal-footer {
            border-top: 1px solid #734002; /* Borde superior */
        }

        .btn-primary {
            background-color: #1F2326; /* Fondo del botón Ingresar */
            color: #F2BF27; /* Texto con acento */
            border: 1px solid #734002; /* Borde con color de la paleta */
        }

        .btn-primary:hover {
            background-color: #F2BF27; /* Acento para hover */
            color: #1F2326;
        }

        #tokenError {
            color: #F2BF27; /* Acento para mensaje de error */
        }

        /* Responsividad */
        @media (max-width: 576px) {
            .table {
                font-size: 0.9rem;
            }

            .unirse-btn {
                padding: 3px 6px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<?php require_once('../app/Views/nav/navbarJuego.php'); ?>
<body>
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
                    <td>
                        <span class="countdown-timer" data-expires="<?= esc($partida['expires_at']) ?>"></span>
                    </td>
                    <td class="estado-partida" data-expires="<?= esc($partida['expires_at']) ?>">
                        <?= esc($partida['status']) ?>
                    </td>
                    <td>
                        <button class="btn btn-success unirse-btn"
                            data-id="<?= esc($partida['id']) ?>"
                            data-expires="<?= esc($partida['expires_at']) ?>">
                        Unirse
                    </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para el token -->
<div class="modal fade" id="tokenModal" tabindex="-1" aria-labelledby="tokenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="tokenForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tokenModalLabel">Ingresar Token</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="partida_id" id="partidaIdInput">
                    <div class="mb-3">
                        <label for="tokenInput" class="form-label">Token de acceso</label>
                        <input type="text" class="form-control" id="tokenInput" name="token" required>
                    </div>
                    <div id="tokenError" class="text-danger" style="display:none;">Token incorrecto.</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const tokenModal = new bootstrap.Modal(document.getElementById('tokenModal'));

    document.querySelectorAll('.unirse-btn').forEach(button => {
        button.addEventListener('click', function () {
            const expires = new Date(this.dataset.expires.replace(' ', 'T')).getTime();
            const now = new Date().getTime() + (5 * 60 * 60 * 1000); 

            if (now > expires) {
                this.disabled = true;
                this.textContent = 'Expirada';
                this.classList.remove('btn-success');
                this.classList.add('btn-danger');
                return;
            }

            document.getElementById('partidaIdInput').value = this.dataset.id;
            document.getElementById('tokenInput').value = '';
            document.getElementById('tokenError').style.display = 'none';
            tokenModal.show();
        });
    });

    document.getElementById('tokenForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const partidaId = document.getElementById('partidaIdInput').value;
        const token = document.getElementById('tokenInput').value;

        fetch(`<?= base_url('partida/verificar-token') ?>`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: partidaId, token: token })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = `<?= base_url('partidas/unirse/') ?>${partidaId}`;
            } else {
                document.getElementById('tokenError').style.display = 'block';
            }
        })
        .catch(() => {
            document.getElementById('tokenError').style.display = 'block';
        });
    });

    function parseDateFromPHPFormat(dateStr) {
        return new Date(dateStr.replace(' ', 'T'));
    }

    function actualizarTiempos() {
        const now = new Date().getTime() + (5 * 60 * 60 * 1000); // hora actual + 5 horas

        document.querySelectorAll('.countdown-timer').forEach(function(el) {
            const expiresAtStr = el.dataset.expires;
            const expiresAt = parseDateFromPHPFormat(expiresAtStr).getTime();
            const diferencia = expiresAt - now;

            const parentRow = el.closest('tr');
            const boton = parentRow.querySelector('.unirse-btn');
            const estadoTd = parentRow.querySelector('.estado-partida');

            if (diferencia <= 0) {
                el.textContent = 'Expirada';
                el.classList.add('text-danger');

                if (boton) {
                    boton.disabled = true;
                    boton.textContent = 'Expirada';
                    boton.classList.remove('btn-success');
                    boton.classList.add('btn-danger');
                }

                if (estadoTd) {
                    estadoTd.textContent = 'Finalizada';
                }
            } else {
                const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
                const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);
                el.textContent = `${minutos}m ${segundos}s`;
            }
        });
    }

    setInterval(actualizarTiempos, 1000);
    actualizarTiempos();
</script>


 <?php require_once('../app/Views/footer/footerJuego.php'); ?>
</body>

   


</html>
