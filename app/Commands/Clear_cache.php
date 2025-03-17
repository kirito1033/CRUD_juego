<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Clear_cache extends BaseCommand
{
    protected $group = 'Cache';
    protected $name = 'clear:cache';
    protected $description = 'Borra el caché de archivos de CodeIgniter';

    public function run(array $params)
    {
        // Borrar el caché de archivos en WRITEPATH/cache
        $cache_path = WRITEPATH . 'cache/';
        $files = glob($cache_path . '*');  // Obtener todos los archivos en el directorio de caché

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);  // Eliminar archivo de caché
            }
        }

        // Mostrar un mensaje indicando que se ha borrado el caché
        CLI::write('Caché borrado exitosamente.', 'green');
    }
}
