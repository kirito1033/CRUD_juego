<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\GameServer;

class GameStartServer extends BaseCommand
{
    protected $group = 'custom';
    protected $name = 'game:startServer';
    protected $description = 'Inicia el servidor WebSocket para el juego.';

    public function run(array $params)
    {
        CLI::write('Iniciando servidor WebSocket en ws://localhost:8080...', 'green');

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new GameServer()
                )
            ),
            8080
        );

        $server->run();
    }
}
