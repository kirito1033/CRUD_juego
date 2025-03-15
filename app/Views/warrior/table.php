            <table class="table" id="table-index">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Total Power</th>
                        <th scope="col">Total Magict</th>
                        <th scope="col">health</th>
                        <th scope="col">speed</th>
                        <th scope="col">intelligence</th>
                        <th scope="col">status</th>
                        <th scope="col">Type</th>
                        <th scope="col">Race</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($warrior) : ?>
                        <?php foreach ($warrior as $obj): ?>
                            <tr class="text-center">
                                <td><?php echo $obj['warrior_id']; ?></td>
                                <td><?php echo $obj['name']; ?></td>
                                <td><?php echo $obj['total_power']; ?></td>
                                <td><?php echo $obj['total_magic']; ?></td>
                                <td><?php echo $obj['health']; ?></td>
                                <td><?php echo $obj['speed']; ?></td>
                                <td><?php echo $obj['intelligence']; ?></td>
                                <td><?php echo $obj['status']; ?></td>

                                <!-- Buscar el nombre del type según el type_id -->
                                <td>
                                    <?php 
                                        $typeNombre = "No asignado"; 
                                        foreach ($types as $type) {
                                            if ($type['type_id'] == $type['type_id']) {
                                                $typeNombre = $type['name'];
                                                break;
                                            }
                                        }
                                        echo $typeNombre;
                                    ?>
                                </td>
                                
                                <!-- Buscar el nombre de la raza según el  race_id-->
                                <td>
                                    <?php 
                                        $raceNombre = "No asignado"; 
                                        foreach ($races as $race) {
                                            if ($race['race_id'] == $obj['race_id']) {
                                                $raceNombre = $race['name'];
                                                break;
                                            }
                                        }
                                        echo $raceNombre;
                                    ?>
                                </td>

                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" onclick="show(<?php echo $obj['warrior_id']; ?>)" 
                                            class="btn btn-success" style="font-size: 0.5em;">SHOW</button>
                                        <button type="button" onclick="edit(<?php echo $obj['warrior_id']; ?>)" 
                                            class="btn btn-warning" style="font-size: 0.5em;">EDIT</button>
                                        <button type="button" onclick="delete_(<?php echo $obj['warrior_id']; ?>)" 
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
                        <th scope="col">Total Power</th>
                        <th scope="col">Total Magict</th>
                        <th scope="col">health</th>
                        <th scope="col">speed</th>
                        <th scope="col">intelligence</th>
                        <th scope="col">status</th>
                        <th scope="col">Type</th>
                        <th scope="col">Race</th>
                        <th scope="col">Actions</th>
            
                    </tr>
                </tfoot>
            </table>
      
