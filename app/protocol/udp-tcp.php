<?php

class UdpTcp extends OpenswooleApp
{
    private string $header_type = 'Content-Type';
    private string $header_content = 'text/plain';
    private mixed $SERVER;

    public function __construct()
    {
        $this->createServer('OpenSwoole\Server');
        global $server_config;
        $this->SERVER = $server_config['server'];
    }

    public function serverOnStart(callable $action): UdpTcp
    {
        $this->on('start', function (Swoole\Server $server) use ($action) {
            $action();
        });
        return $this;
    }

    public function header(string $type, string $content): UdpTcp
    {
        $this->header_type = $type;
        $this->header_content = $content;
        return $this;
    }

    public function end(Mixed $data = null): UdpTcp
    {
        $this->on("request", function (Swoole\Http\Request $request, Swoole\Http\Response $response) use ($data) {
            $response->header($this->header_type, $this->header_content);
            $response->end($data);
        });
        return $this;
    }

    public function set(array $settings): UdpTcp
    {
        $this->SERVER->set($settings);
        return $this;
    }

    public function on(string $event, callable $action): UdpTcp
    {
        $this->SERVER->on($event, $action);
        return $this;
    }

    public function listen(string $host, int $port, string $socket_type): UdpTcp
    {
        $this->SERVER->listen($host, $port, $socket_type);
        return $this;
    }

    public function addListener(string $host, int $port, string $socket_type): UdpTcp
    {
        $this->SERVER->addListener($host, $port, $socket_type);
        return $this;
    }

    public function addProcess(OpenSwoole\Process $process): UdpTcp
    {
        $this->SERVER->addProcess($process);
        return $this;
    }

    public function addTimer(int $interval): UdpTcp
    {
        $this->SERVER->addTimer($interval);
        return $this;
    }

    public function start(): UdpTcp
    {
        $this->SERVER->start();
        return $this;
    }

    public function reload(bool $onlyReloadTaskworker = false): UdpTcp
    {
        $this->SERVER->reload($onlyReloadTaskworker);
        return $this;
    }

    public function stop(int $workerId = -1, bool $waitEvent = false): UdpTcp
    {
        $this->SERVER->stop($workerId, $waitEvent);
        return $this;
    }

    public function shutdown(): UdpTcp
    {
        $this->SERVER->shutdown();
        return $this;
    }

    public function close(int $fd, bool $force = false): UdpTcp
    {
        $this->SERVER->close($fd, $force);
        return $this;
    }

    public function exist(int $fd): UdpTcp
    {
        $this->SERVER->exist($fd);
        return $this;
    }

    public function pause(int $fd): UdpTcp
    {
        $this->SERVER->pause($fd);
        return $this;
    }

    public function resume(int $fd): UdpTcp
    {
        $this->SERVER->resume($fd);
        return $this;
    }

    public function finish(mixed $data): UdpTcp
    {
        $this->SERVER->finish($data);
        return $this;
    }

    public function protect(int $fd, bool $value = true): UdpTcp
    {
        $this->SERVER->protect($fd, $value);
        return $this;
    }

    public function confirm(int $fd): UdpTcp
    {
        $this->SERVER->confirm($fd);
        return $this;
    }

    public function heartbeat(bool $ifCloseConnection = true): UdpTcp
    {
        $this->SERVER->heartbeat($ifCloseConnection);
        return $this;
    }

    public function getLastError(): UdpTcp
    {
        $this->SERVER->getLastError();
        return $this;
    }

    public function getSocket(): UdpTcp
    {
        $this->SERVER->getSocket();
        return $this;
    }

    public function getReceivedTime(): UdpTcp
    {
        $this->SERVER->getReceivedTime();
        return $this;
    }

    public function getWorkerId(): UdpTcp
    {
        $this->SERVER->getWorkerId();
        return $this;
    }

    public function getManagerPid(): UdpTcp
    {
        $this->SERVER->getManagerPid();
        return $this;
    }

    public function getMasterPid(): UdpTcp
    {
        $this->SERVER->getMasterPid();
        return $this;
    }

    public function getWorkerPid(int $workerId = -1): UdpTcp
    {
        $this->SERVER->getWorkerPid($workerId);
        return $this;
    }

    public function getWorkerStatus(int $workerId = -1): UdpTcp
    {
        $this->SERVER->getWorkerStatus($workerId);
        return $this;
    }

    public function bind(int $fd, int $uid): UdpTcp
    {
        $this->SERVER->bind($fd, $uid);
        return $this;
    }

    public function stats(int $mode = \OpenSwoole\Constant::STATS_DEFAULT): UdpTcp
    {
        $this->SERVER->stats($mode);
        return $this;
    }

    public function task(mixed $data, int $dstWorkerId = -1, callable $finishCallback = null): UdpTcp
    {
        $this->SERVER->task($data, $dstWorkerId, $finishCallback);
        return $this;
    }

    public function taskwait(mixed $data, float $timeout = 0.5, int $dstWorkerId = -1): UdpTcp
    {
        $this->SERVER->taskwait($data, $timeout, $dstWorkerId);
        return $this;
    }

    public function taskWaitMulti(array $tasks, float $timeout = 0.5): UdpTcp
    {
        $this->SERVER->taskWaitMulti($tasks, $timeout);
        return $this;
    }

    public function taskCo(array $tasks, float $timeout = 0.5): UdpTcp
    {
        $this->SERVER->taskCo($tasks, $timeout);
        return $this;
    }

    public function tick(int $milliseconds, mixed $callback): UdpTcp
    {
        $this->SERVER->tick($milliseconds, $callback);
        return $this;
    }

    public function after(int $millisecond, mixed $callback): UdpTcp
    {
        $this->SERVER->after($millisecond, $callback);
        return $this;
    }

    public function defer(callable $callback): UdpTcp
    {
        $this->SERVER->defer($callback);
        return $this;
    }

    public function clearTimer(int $timerId): UdpTcp
    {
        $this->SERVER->clearTimer($timerId);
        return $this;
    }

    public function send(int $fd, string $data, int $serverSocket = -1): UdpTcp
    {
        $this->SERVER->send($fd, $data, $serverSocket);
        return $this;
    }

    public function sendfile(int $fd, string $filename, int $offset = 0, int $length = 0): UdpTcp
    {
        $this->SERVER->sendfile($fd, $filename, $offset, $length);
        return $this;
    }

    public function sendto(string $ip, int $port, string $data, int $serverSocket = -1): UdpTcp
    {
        $this->SERVER->sendto($ip, $port, $data, $serverSocket);
        return $this;
    }

    public function sendwait(int $fd, string $data): UdpTcp
    {
        $this->SERVER->sendwait($fd, $data);
        return $this;
    }

    // Check sendMessage Methode Later !!!

    public function getCallback(string $eventName): UdpTcp
    {
        $this->SERVER->getCallback($eventName);
        return $this;
    }

    public function getClientInfo(int $fd, int $reactorId, bool $ignoreError = false): UdpTcp
    {
        $this->SERVER->getClientInfo($fd, $reactorId, $ignoreError);
        return $this;
    }

    public function getClientList(int $startFd = 0, int $pageSize = 10): UdpTcp
    {
        $this->SERVER->getClientList($startFd, $pageSize);
        return $this;
    }
}