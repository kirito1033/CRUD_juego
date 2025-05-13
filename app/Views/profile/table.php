            <table class="table" id="table-index">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">photo</th>
                        <th scope="col">Jugador_Usuario</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($profileModel) : ?>
                        <?php foreach ($profileModel as $obj): ?>
                            <tr class="text-center">
                                <td><?php echo $obj['profile_id']; ?></td>
                                <td><?php echo $obj['profile_email']; ?></td>
                                <td><?php echo $obj['profile_name']; ?></td>
                                <td><?php echo $obj['profile_photo']; ?></td>
                                <!-- Buscar el nombre del rol según el roles_fk -->
                                <td>
                                    <?php 
                                        $jugadorNombre = "No asignado"; 
                                        foreach ($jugadores as $jugador) {
                                            if ($jugador['jugador_id'] == $obj['jugador_id_fk']) {
                                                $jugadorNombre = $jugador['jugador_name'];
                                                break;
                                            }
                                        }
                                        echo $jugadorNombre;
                                    ?>
                                </td>

                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" onclick="show(<?php echo $obj['profile_id']; ?>)" 
                                            class="btn btn-success" style="font-size: 0.5em;">SHOW</button>
                                        <button type="button" onclick="edit(<?php echo $obj['profile_id']; ?>)" 
                                            class="btn btn-warning" style="font-size: 0.5em;">EDIT</button>
                                        <button type="button" onclick="delete_(<?php echo $obj['profile_id']; ?>)" 
                                            class="btn btn-danger" style="font-size: 0.5em;">DELETE</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </tbody>
                
            </table>
      
