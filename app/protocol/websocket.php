<?php

class WebSocket extends OpenswooleApp
{
    private string $header_type = 'Content-Type';
    private string $header_content = 'text/plain';
    private mixed $SERVER;

    public function __construct()
    {
        $this->createServer('OpenSwoole\WebSocket\Server');
        global $server_config;
        $this->SERVER = $server_config['server'];
    }

    public function serverOnStart(callable $action): WebSocket
    {
        $this->on('start', function (Swoole\WebSocket\Server $server) use ($action) {
            $action();
        });
        return $this;
    }

    public function header(string $type, string $content): WebSocket
    {
        $this->header_type = $type;
        $this->header_content = $content;
        return $this;
    }

    public function end(Mixed $data = null): WebSocket
    {
        $this->on("request", function (Swoole\Http\Request $request, Swoole\Http\Response $response) use ($data) {
            $response->header($this->header_type, $this->header_content);
            $response->end($data);
        });
        return $this;
    }

    public function on(string $event, callable $action): WebSocket
    {
        $this->SERVER->on($event, $action);
        return $this;
    }

    public function start(): WebSocket
    {
        $this->SERVER->start();
        return $this;
    }

    public function exist(int $fd): WebSocket
    {
        $this->SERVER->exist($fd);
        return $this;
    }

    public function getClientInfo(int $fd): WebSocket
    {
        $this->SERVER->getClientInfo($fd);
        return $this;
    }

    public function push(int $fd, string $data, int $opcode = 1, int $flags = OpenSwoole\WebSocket\Server::WEBSOCKET_FLAG_FIN): WebSocket
    {
        $this->SERVER->push($fd, $data, $opcode, $flags);
        return $this;
    }

    public function pack(string $data, int $opcode = WEBSOCKET_OPCODE_TEXT, int $flags = OpenSwoole\WebSocket\Server::WEBSOCKET_FLAG_FIN): WebSocket
    {
        $this->SERVER->pack($data, $opcode, $flags);
        return $this;
    }

    public function unpack(string $data): WebSocket
    {
        $this->SERVER->unpack($data);
        return $this;
    }

    public function disconnect(int $fd, int $code = OpenSwoole\WebSocket\Server::WEBSOCKET_CLOSE_NORMAL, string $reason = ''): WebSocket
    {
        $this->SERVER->disconnect($fd, $code, $reason);
        return $this;
    }

    public function isEstablished(int $fd): WebSocket
    {
        $this->SERVER->isEstablished($fd);
        return $this;
    }
}