<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value="null">
    <input type="hidden" class="form-control" id="update_at" name="update_at" value="null">
    <input type="hidden" class="form-control" id="expires_at" name="expires_at" value="">

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="game_name" name="game_name" placeholder="Nombre de la Partida" required>
        <label for="game_name">Nombre de la Partida</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="game_mode" name="game_mode" value="1vs1" placeholder="Modo de Juego" readonly>
        <label for="game_mode">Modo de Juego</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="duration" name="duration" min="5" max="60" placeholder="Duración" required>
        <label for="duration">Duración (minutos)</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="win_condition" name="win_condition" required>
            <option value="poder">Por Poder</option>
            <option value="magia">Por Magia</option>
            <option value="suma">Suma de Poder y Magia</option>
        </select>
        <label for="win_condition">Condición de Victoria</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="player_life" name="player_life" min="100" max="10000" value="300" placeholder="Vida Inicial del Jugador" required>
        <label for="player_life">Vida Inicial del Jugador</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="status" name="status">
            <option value="publica">Pública</option>
            <option value="privada">Privada</option>
            <option value="esperando_jugador">Esperando jugador</option>
            <option value="en_batalla">En batalla</option>
            <option value="finalizada">Finalizada</option>
        </select>
        <label for="status">Estado</label>
    </div>
</form>

<script>
    document.getElementById('duration').addEventListener('input', function () {
        const duration = parseInt(this.value);
        if (!isNaN(duration)) {
            const now = new Date();
            now.setMinutes(now.getMinutes() + duration);
            const isoString = now.toISOString();
            document.getElementById('expires_at').value = isoString;
        }
    });
</script>
