<?php

class Http extends OpenswooleApp
{
    private string $header_type = 'Content-Type';
    private string $header_content = 'text/plain';
    private mixed $SERVER;

    public function __construct()
    {
        $this->create('OpenSwoole\HTTP\Server');
        global $server_config;
        $this->SERVER = $server_config['server'];
    }

    public function serverOnStart(callable $action): Http
    {
        $this->on('start', function (Swoole\Http\Server $server) use ($action) {
            $action();
        });
        return $this;
    }

    public function header(string $type, string $content): Http
    {
        $this->header_type = $type;
        $this->header_content = $content;
        return $this;
    }

    public function end(Mixed $data = null): Http
    {
        $this->on("request", function (Swoole\Http\Request $request, Swoole\Http\Response $response) use ($data) {
            $response->header($this->header_type, $this->header_content);
            $response->end($data);
        });
        return $this;
    }

    public function set(array $settings): Http
    {
        $this->SERVER->set($settings);
        return $this;
    }

    public function on(string $event, callable $action): Http
    {
        $this->SERVER->on($event, $action);
        return $this;
    }

    public function listen(string $host, int $port, string $socket_type): Http
    {
        $this->SERVER->listen($host, $port, $socket_type);
        return $this;
    }

    public function addListener(string $host, int $port, string $socket_type): Http
    {
        $this->SERVER->addListener($host, $port, $socket_type);
        return $this;
    }

    public function addProcess(OpenSwoole\Process $process): Http
    {
        $this->SERVER->addProcess($process);
        return $this;
    }

    public function start(): Http
    {
        $this->SERVER->start();
        return $this;
    }

    public function reload(bool $onlyReloadTaskworker = false): Http
    {
        $this->SERVER->reload($onlyReloadTaskworker);
        return $this;
    }

    public function stop(int $workerId = -1, bool $waitEvent = false): Http
    {
        $this->SERVER->stop($workerId, $waitEvent);
        return $this;
    }

    public function shutdown(): Http
    {
        $this->SERVER->shutdown();
        return $this;
    }

    public function close(int $fd, bool $force = false): Http
    {
        $this->SERVER->close($fd, $force);
        return $this;
    }

    public function exist(int $fd): Http
    {
        $this->SERVER->exist($fd);
        return $this;
    }

    public function pause(int $fd): Http
    {
        $this->SERVER->pause($fd);
        return $this;
    }

    public function resume(int $fd): Http
    {
        $this->SERVER->resume($fd);
        return $this;
    }

    public function finish(mixed $data): Http
    {
        $this->SERVER->finish($data);
        return $this;
    }

    public function protect(int $fd, bool $value = true): Http
    {
        $this->SERVER->protect($fd, $value);
        return $this;
    }

    public function heartbeat(bool $ifCloseConnection = true): Http
    {
        $this->SERVER->heartbeat($ifCloseConnection);
        return $this;
    }

    public function getLastError(): Http
    {
        $this->SERVER->getLastError();
        return $this;
    }

    public function getSocket(): Http
    {
        $this->SERVER->getSocket();
        return $this;
    }

    public function bind(int $fd, int $uid): Http
    {
        $this->SERVER->bind($fd, $uid);
        return $this;
    }

    public function stats(int $mode = \OpenSwoole\Constant::STATS_DEFAULT): Http
    {
        $this->SERVER->stats($mode);
        return $this;
    }

    public function tick(int $milliseconds, mixed $callback): Http
    {
        $this->SERVER->tick($milliseconds, $callback);
        return $this;
    }

    public function after(int $millisecond, mixed $callback): Http
    {
        $this->SERVER->after($millisecond, $callback);
        return $this;
    }

    public function defer(callable $callback): Http
    {
        $this->SERVER->defer($callback);
        return $this;
    }

    public function clearTimer(int $timerId): Http
    {
        $this->SERVER->clearTimer($timerId);
        return $this;
    }

    public function send(int $fd, string $data, int $serverSocket = -1): Http
    {
        $this->SERVER->send($fd, $data, $serverSocket);
        return $this;
    }

    public function sendfile(int $fd, string $filename, int $offset = 0, int $length = 0): Http
    {
        $this->SERVER->sendfile($fd, $filename, $offset, $length);
        return $this;
    }

    public function sendto(string $ip, int $port, string $data, int $serverSocket = -1): Http
    {
        $this->SERVER->sendto($ip, $port, $data, $serverSocket);
        return $this;
    }

    public function sendwait(int $fd, string $data): Http
    {
        $this->SERVER->sendwait($fd, $data);
        return $this;
    }

    // Check sendMessage Methode Later !!!

    public function getClientInfo(int $fd, int $reactorId, bool $ignoreError = false): Http
    {
        $this->SERVER->getClientInfo($fd, $reactorId, $ignoreError);
        return $this;
    }

    public function getClientList(int $startFd = 0, int $pageSize = 10): Http
    {
        $this->SERVER->getClientList($startFd, $pageSize);
        return $this;
    }
}