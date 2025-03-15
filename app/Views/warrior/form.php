<form id="my-form">
    <input type="hidden" class="form-control" id="warrior_id" name="warrior_id" value="null">
    <input type="hidden" class="form-control" id="update_at" name="update_at" value="null">

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
        <label for="name">Name</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="total_power" name="total_power" placeholder="Total power" required>
        <label for="total_power">Total power</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="total_magic" name="total_magic" placeholder="Total magic" required>
        <label for="total_magic">Total magic</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="health" name="health" placeholder="Health" required>
        <label for="health">Health</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="speed" name="speed" placeholder="Speed" required>
        <label for="Speed">Speed</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="intelligence" name="intelligence" placeholder="Intelligence" required>
        <label for="intelligence">Intelligence</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="status" name="status" placeholder="Status" required>
        <label for="status">Status</label>
    </div>
    <div class="form-floating mb-3">
    <select class="form-select" id="type_id" name="type_id" required>
    <option value="">Seleccione un Tipo de guerrero</option>
        <?php foreach ($types as $type) : ?>
            <option value="<?= $type['type_id']; ?>"><?= $type['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="type_id">Type Warrior</label>
    </div>

    <div class="form-floating mb-3">
    <select class="form-select" id="race_id" name="race_id" required>
        <option value="">Seleccione una raza</option>
        <?php foreach ($races as $race) : ?>
            <option value="<?= $race['race_id']; ?>"><?= $race['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="race_id">Raza</label>
    </div>

</form>

