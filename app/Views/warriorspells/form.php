<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value="null">
    <input type="hidden" class="form-control" id="update_at" name="update_at" value="null">

    <div class="form-floating mb-3">
    <select class="form-select" id="warrior_id" name="warrior_id" required>
    <option value="">Seleccione un guerrero</option>
        <?php foreach ($warriors as $warrior) : ?>
            <option value="<?= $warrior['warrior_id']; ?>"><?= $warrior['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="warrior_id">Warrior</label>
    </div>

    <div class="form-floating mb-3">
    <select class="form-select" id="spell_id" name="spell_id" required>
        <option value="">Seleccione un hechizo</option>
        <?php foreach ($spells as $spell) : ?>
            <option value="<?= $spell['spell_id']; ?>"><?= $spell['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="spell_id">Spells</label>
    </div>

</form>

