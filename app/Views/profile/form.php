<form id="my-form">
    <input type="hidden" class="form-control" id="profile_id" name="profile_id" value="null">
    <input type="hidden" class="form-control" id="update_at" name="update_at" value="null">

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="profile_email" name="profile_email" placeholder="Email" required>
        <label for="profile_email">Email</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="profile_name" name="profile_name" placeholder="Name" required>
        <label for="profile_name">Name</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="profile_photo" name="profile_photo" placeholder="photo" required>
        <label for="profile_photo">Photo</label>
    </div>

    <div class="form-floating mb-3">
    <select class="form-select" id="jugador_id_fk" name="jugador_id_fk" required>
    <option value="">Seleccione un jugador</option>
        <?php foreach ($jugadores as $jugador) : ?>
            <option value="<?= $jugador['jugador_id']; ?>"><?= $jugador['jugador_name']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="jugador_id_fk">Jugador</label>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

