<?php

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
        require_once 'app/protocol/udp-tcp.php';
        return new UdpTcp();
    }

    public function Http(): Http
    {
        require_once 'app/protocol/http.php';
        return new Http();
    }

    public function WebSocket(): WebSocket
    {
        require_once 'app/protocol/websocket.php';
        return new WebSocket();
    }

    public function Event(): Event
    {
        require_once 'app/schedule/event.php';
        return new Event();
    }

    public function Timer(): Timer
    {
        require_once 'app/schedule/timer.php';
        return new Timer();
    }

    public function Coroutine(): Coroutine
    {
        require_once 'app/php-coroutine/coroutine.php';
        return new Coroutine();
    }

    public function CoSystem(): CoSystem
    {
        require_once 'app/php-coroutine/coroutine-system.php';
        return new CoSystem();
    }

    public function CoChannel(): CoChannel
    {
        require_once 'app/php-coroutine/coroutine-channel.php';
        return new CoChannel();
    }

    public function CoWaitGroup(): CoWaitGroup
    {
        require_once 'app/php-coroutine/coroutine-wait-group.php';
        return new CoWaitGroup();
    }

    public function CoServer(): CoServer
    {
        require_once 'app/php-coroutine/coroutine-server.php';
        return new CoServer();
    }
}