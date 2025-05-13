            <table class="table" id="table-index">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Warrior</th>
                        <th scope="col">Power</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($WarriorPowerModel) : ?>
                        <?php foreach ($WarriorPowerModel as $obj): ?>
                            <tr class="text-center">
                                <td><?php echo $obj['id']; ?></td>
                                <!-- Buscar el nombre del type según el type_id -->
                                <td>
                                    <?php 
                                        $typeNombre = "No asignado"; 
                                        foreach ($warriors as $warrior) {
                                            if ($warrior['warrior_id'] == $obj['warrior_id']) {
                                                $warriorNombre = $warrior['name'];
                                                break;
                                            }
                                        }
                                        echo $warriorNombre;
                                    ?>
                                </td>
                                
                                <!-- Buscar el nombre de la raza según el  race_id-->
                                <td>
                                    <?php 
                                        $raceNombre = "No asignado"; 
                                        foreach ($powers as $power) {
                                            if ($power['power_id'] == $obj['power_id']) {
                                                $powerNombre = $power['name'];
                                                break;
                                            }
                                        }
                                        echo $powerNombre;
                                    ?>
                                </td>

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

                    <?php endif; ?>
                </tbody>
              
            </table>
      
