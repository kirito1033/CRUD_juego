<form id="my-form">
    <input type="hidden" class="form-control" id="jugador_id" name="jugador_id" value="null">
    <input type="hidden" class="form-control" id="update_at" name="update_at" value="null">

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="jugador_name" name="jugador_name" placeholder="Name" required>
        <label for="jugador_name">Name</label>
    </div>

    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="jugador_password" name="jugador_password" placeholder="Password" required>
        <label for="jugador_password">Password</label>
    </div>

    <div class="form-floating mb-3">
    <select class="form-select" id="roles_fk" name="roles_fk" required>
    <option value="">Seleccione un Rol</option>
        <?php foreach ($roles as $rol) : ?>
            <option value="<?= $rol['Roles_id']; ?>"><?= $rol['Roles_name']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="roles_fk">Rol</label>
    </div>

    <div class="form-floating mb-3">
    <select class="form-select" id="jugador_status_fk" name="jugador_status_fk" required>
        <option value="">Seleccione un Estado</option>
        <?php foreach ($estados as $estado) : ?>
            <option value="<?= $estado['Jugador_status_id']; ?>"><?= $estado['Jugador_status_name']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="jugador_status_fk">Estado Jugador</label>
    </div>
</form>

