            <table class="table" id="table-index">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($jugadorRol) : ?>
                        <?php foreach ($jugadorRol as $obj): ?>
                            <tr class="text-center">
                                <td><?php echo $obj['Roles_id']; ?></td>
                                <td><?php echo $obj['Roles_name']; ?></td>
                                <td><?php echo $obj['Roles_description']; ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" onclick="show(<?php echo $obj['Roles_id']; ?>)" 
                                        class="btn btn-success" style="font-size: 0.5em;">SHOW</button>
                                        <button type="button" onclick="edit(<?php echo $obj['Roles_id']; ?>)" 
                                        class="btn btn-warning" style="font-size: 0.5em;">EDIT</button>
                                        <button type="button" onclick="delete_(<?php echo $obj['Roles_id']; ?>)" 
                                        class="btn btn-danger" style="font-size: 0.5em;">DELETE</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </tfoot>
            </table>
      
