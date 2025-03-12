            <table class="table" id="table-index">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Password</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($jugadorModel) : ?>
                        <?php foreach ($jugadorModel as $obj): ?>
                            <tr class="text-center">
                                <td><?php echo $obj['jugador_id']; ?></td>
                                <td><?php echo $obj['jugador_name']; ?></td>
                                <td><?php echo $obj['jugador_password']; ?></td>
                                
                                <!-- Buscar el nombre del rol según el roles_fk -->
                                <td>
                                    <?php 
                                        $rolNombre = "No asignado"; 
                                        foreach ($roles as $rol) {
                                            if ($rol['Roles_id'] == $obj['roles_fk']) {
                                                $rolNombre = $rol['Roles_name'];
                                                break;
                                            }
                                        }
                                        echo $rolNombre;
                                    ?>
                                </td>
                                
                                <!-- Buscar el nombre del estado según el jugador_status_fk -->
                                <td>
                                    <?php 
                                        $estadoNombre = "No asignado"; 
                                        foreach ($estados as $estado) {
                                            if ($estado['Jugador_status_id'] == $obj['jugador_status_fk']) {
                                                $estadoNombre = $estado['Jugador_status_name'];
                                                break;
                                            }
                                        }
                                        echo $estadoNombre;
                                    ?>
                                </td>

                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" onclick="show(<?php echo $obj['jugador_id']; ?>)" 
                                            class="btn btn-success" style="font-size: 0.5em;">SHOW</button>
                                        <button type="button" onclick="edit(<?php echo $obj['jugador_id']; ?>)" 
                                            class="btn btn-warning" style="font-size: 0.5em;">EDIT</button>
                                        <button type="button" onclick="delete_(<?php echo $obj['jugador_id']; ?>)" 
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
                        <th scope="col">Password</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Actions</th>
                    </tr>
                </tfoot>
            </table>
      
