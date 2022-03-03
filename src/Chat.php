<?php

namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface{
    protected $clients;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        echo "#server iniciado";
    }
    public function onOpen(ConnectionInterface $conn)
    {
        #Almacenar la nueva conexión para enviar mensajes más tarde
        $this->clients->attach($conn);
        echo "Nueva conexion ({$conn->resourceId})\n";
    }
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Conexion %d Enviando Mensaje "%s" to %d Otra conexion%s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        
        foreach ($this->clients as $client) {
            if($from !== $client){
                # The sender is not the receiver, send to each client connecte
                $client->send($msg);
            }
        }
    }
    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Conexion {$conn->resourceId} ha sido Finalizada.\n";
    }
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Ups! ha ocurrido un error: {$e->getMessage()}\n";

        $conn->close();
    }
}