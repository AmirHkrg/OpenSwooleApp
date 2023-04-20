<?php

class CoServer extends OpenswooleApp
{
    private mixed $SERVER;

    public function newServer(string $host, int $port = 0, bool $ssl = false, bool $reusePort = false): CoServer
    {
        $this->SERVER = new OpenSwoole\Coroutine\Server($host, $port, $ssl, $reusePort);
        return $this;
    }

    public function set(array $options): CoServer
    {
        $this->SERVER->set($options);
        return $this;
    }

    public function handle(callable $callback): CoServer
    {
        $this->SERVER->handle($callback);
        return $this;
    }

    public function start(): CoServer
    {
        $this->SERVER->start();
        return $this;
    }

    public function shutdown(): CoServer
    {
        $this->SERVER->shutdown();
        return $this;
    }
}