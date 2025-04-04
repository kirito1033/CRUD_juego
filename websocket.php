<?php
require 'vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class GameServer implements MessageComponentInterface {
    protected $clients = [];
    protected $partidas = [];

    public function onOpen(ConnectionInterface $conn) {
        $this->clients[$conn->resourceId] = $conn;
        echo "Nueva conexión: {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        
        if (!$data) {
            echo "Mensaje inválido recibido.\n";
            return;
        }

        switch ($data['action']) {
            case 'joinGame':
                $this->handleJoinGame($from, $data);
                break;

            case 'gameMove':
                $this->handleGameMove($from, $data);
                break;

            case 'chatMessage':
                $this->broadcastMessage($from, $data);
                break;

            default:
                echo "Acción desconocida: {$data['action']}\n";
        }
    }

    private function handleJoinGame(ConnectionInterface $conn, $data) {
        $partidaId = $data['partida_id'];

        if (!isset($this->partidas[$partidaId])) {
            $this->partidas[$partidaId] = [];
        }

        $this->partidas[$partidaId][] = $conn;

        echo "Jugador {$conn->resourceId} se unió a la partida $partidaId\n";

        foreach ($this->partidas[$partidaId] as $client) {
            $client->send(json_encode([
                'action' => 'playerJoined',
                'player' => $conn->resourceId
            ]));
        }
    }

    private function handleGameMove(ConnectionInterface $conn, $data) {
        $partidaId = $data['partida_id'];

        if (!isset($this->partidas[$partidaId])) return;

        foreach ($this->partidas[$partidaId] as $client) {
            if ($client !== $conn) {
                $client->send(json_encode([
                    'action' => 'gameUpdate',
                    'move' => $data['move']
                ]));
            }
        }
    }

    private function broadcastMessage(ConnectionInterface $conn, $data) {
        foreach ($this->clients as $client) {
            if ($client !== $conn) {
                $client->send(json_encode([
                    'action' => 'chatMessage',
                    'message' => $data['message']
                ]));
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        unset($this->clients[$conn->resourceId]);
        echo "Conexión cerrada: {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Iniciar el servidor WebSocket
$server = IoServer::factory(
    new HttpServer(
        new WsServer(new GameServer())
    ),
    8080
);

echo "Servidor WebSocket en ejecución en ws://localhost:8080\n";
$server->run();