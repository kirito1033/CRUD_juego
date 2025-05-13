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
                                <td><input type="password" name="" id="" value="<?php echo $obj['jugador_password']; ?>"></td>
                                
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
                
            </table>
      
<style>
    td {
        background-color: #2A2F33; /* Fondo de la celda */
        border: 1px solid #734002; /* Borde con color de la paleta */
        padding: 8px; /* Relleno para la celda */
        vertical-align: middle;
    }

    input[type="password"] {
        background-color: #BF8415; /* Fondo del input */
        border: 1px solid #734002; /* Borde con color de la paleta */
        color: #1F2326; /* Texto oscuro para contraste */
        border-radius: 5px; /* Bordes redondeados */
        padding: 5px 10px; /* Relleno interno */
        width: 100%; /* Ocupa todo el ancho de la celda */
        font-size: 0.9rem; /* Tamaño de fuente */
        transition: background-color 0.3s, border-color 0.3s, box-shadow 0.3s;
    }

    input[type="password"]::placeholder {
        color: #734002; /* Color del placeholder */
    }

    input[type="password"]:focus {
        background-color: #F2BF27; /* Acento para input activo */
        border-color: #734002; /* Mantiene el borde */
        color: #1F2326; /* Texto oscuro */
        outline: none; /* Elimina el contorno predeterminado */
        box-shadow: 0 0 5px #F2BF27; /* Sombra con acento */
    }

    /* Responsividad */
    @media (max-width: 576px) {
        input[type="password"] {
            font-size: 0.8rem; /* Tamaño de fuente más pequeño */
            padding: 4px 8px; /* Relleno ajustado */
        }
    }
</style>