<table class="table" id="table-index">
        <thead class="table-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Modo</th>
                <th>Duración</th>
                <th>Victoria</th>
                <th>Vida</th>
                <th>Estado</th>
                <th>Token</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($partidaModel) : ?>
                <?php foreach ($partidaModel as $obj): ?>
                    <tr class="text-center">
                        <td><?= $obj['id']; ?></td>
                        <td><?= $obj['game_name']; ?></td>
                        <td><?= $obj['game_mode']; ?></td>
                        <td><?= $obj['duration']; ?> min</td>
                        <td><?= ucfirst($obj['win_condition']); ?></td>
                        <td><?= $obj['player_life']; ?></td>
                        <td><?= ucfirst($obj['status']); ?></td>
                        <td><?= $obj['token']; ?></td>
                        <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" onclick="show(<?php echo $obj['id']; ?>)" 
                                            class="btn btn-success" style="font-size: 0.5em;">SHOW</button>
                                        <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" 
                                            class="btn btn-warning" style="font-size: 0.5em;">EDIT</button>
                                        <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" 
                                            class="btn btn-danger" style="font-size: 0.5em;">DELETE</button>
                                    </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">No hay partidas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>