<?php
require_once 'app/udptcp.php';
require_once 'app/http.php';
require_once 'app/websocket.php';
require_once 'app/event.php';
require_once 'app/timer.php';
require_once 'app/coroutine.php';

class OpenswooleApp
{
    public function __construct(string $address = '127.0.0.1', int $port = 9501, int $mode = OpenSwoole\Server::POOL_MODE, int $sock_type = OpenSwoole\Constant::SOCK_TCP)
    {
        global $server_config;
        $server_config['addr'] = $address;
        $server_config['port'] = $port;
        $server_config['mode'] = $mode;
        $server_config['type'] = $sock_type;
    }

    protected function createServer(string $server_type): void
    {
        global $server_config;
        $server_config['server'] = new $server_type($server_config['addr'], $server_config['port'], $server_config['mode'], $server_config['type']);
    }

    public function getConfig(): array|null
    {
        global $server_config;
        return ['address' => $server_config['addr'], 'port' => $server_config['port'], 'mode' => $server_config['mode'], 'type' => $server_config['type']];
    }

    public function UdpTcp(): UdpTcp
    {
        return new UdpTcp();
    }

    public function Http(): Http
    {
        return new Http();
    }

    public function WebSocket(): WebSocket
    {
        return new WebSocket();
    }

    public function Event(): Event
    {
        return new Event();
    }

    public function Timer(): Timer
    {
        return new Timer();
    }

    public function Coroutine(): Coroutine
    {
        return new Coroutine();
    }
}