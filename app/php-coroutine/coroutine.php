<?php

class Coroutine extends OpenswooleApp
{
    public function create(callable $callback, ...$params): Coroutine
    {
        OpenSwoole\Coroutine::create($callback, $params);
        return $this;
    }

    public function run(callable $action): Coroutine
    {
        OpenSwoole\Coroutine::run($action);
        return $this;
    }

    public function set($options): Coroutine
    {
        OpenSwoole\Coroutine::set($options);
        return $this;
    }

    public function dnsLookup(string $domain, float $timeout = 5): Coroutine
    {
        OpenSwoole\Coroutine\System::dnsLookup($domain, $timeout);
        return $this;
    }

    public function getCid(): Coroutine
    {
        OpenSwoole\Coroutine::getCid();
        return $this;
    }

    public function getPcid(int $cid = 0): Coroutine
    {
        OpenSwoole\Coroutine::getPcid($cid);
        return $this;
    }

    public function exists(int $cid): Coroutine
    {
        OpenSwoole\Coroutine::exists($cid);
        return $this;
    }

    public function getElapsed(int $cid = 0): Coroutine
    {
        OpenSwoole\Coroutine::getElapsed($cid);
        return $this;
    }

    public function getContext(int $cid = 0): Coroutine
    {
        OpenSwoole\Coroutine::getContext($cid);
        return $this;
    }

    public function disableScheduler(): Coroutine
    {
        OpenSwoole\Coroutine::disableScheduler();
        return $this;
    }

    public function enableScheduler(): Coroutine
    {
        OpenSwoole\Coroutine::enableScheduler();
        return $this;
    }

    public function yield(): Coroutine
    {
        OpenSwoole\Coroutine::yield();
        return $this;
    }

    public function resume(int $cid): Coroutine
    {
        OpenSwoole\Coroutine::resume($cid);
        return $this;
    }

    public function sleep(int $seconds): Coroutine
    {
        OpenSwoole\Coroutine\System::sleep($seconds);
        return $this;
    }

    public function defer(callable $callback): Coroutine
    {
        OpenSwoole\Coroutine::defer($callback);
        return $this;
    }

    public function gethostbyname(string $domain, int $family = AF_INET, float $timeout = -1): Coroutine
    {
        OpenSwoole\Coroutine\System::gethostbyname($domain, $family, $timeout);
        return $this;
    }

    public function getaddrinfo(string $domain, int $family = AF_INET, int $sockType = SOCK_STREAM, int $protocol = STREAM_IPPROTO_TCP, string $service = null, float $timeout = -1): Coroutine
    {
        OpenSwoole\Coroutine\System::gethostbyname($domain, $family, $sockType, $protocol, $service, $timeout);
        return $this;
    }

    public function exec(string $cmd): Coroutine
    {
        OpenSwoole\Coroutine\System::exec($cmd);
        return $this;
    }

    public function readFile(string $filename): Coroutine
    {
        OpenSwoole\Coroutine\System::readFile($filename);
        return $this;
    }

    public function writeFile(string $filename, string $fileContent, int $flags): Coroutine
    {
        OpenSwoole\Coroutine\System::writeFile($filename, $fileContent, $flags);
        return $this;
    }

    public function stats(): Coroutine
    {
        OpenSwoole\Coroutine::stats();
        return $this;
    }

    public function getBackTrace(int $cid = 0, int $options = \DEBUG_BACKTRACE_PROVIDE_OBJECT, int $limit = 0): Coroutine
    {
        OpenSwoole\Coroutine::getBackTrace($cid, $options, $limit);
        return $this;
    }

    public function list(): Coroutine
    {
        OpenSwoole\Coroutine::list();
        return $this;
    }

    public function enableCoroutine(): Coroutine
    {
        OpenSwoole\Coroutine::enableCoroutine();
        return $this;
    }

    public function cancel(int $cid): Coroutine
    {
        OpenSwoole\Coroutine::enableCoroutine($cid);
        return $this;
    }

    public function isCanceled(int $cid): Coroutine
    {
        OpenSwoole\Coroutine::isCanceled($cid);
        return $this;
    }

    public function select(array $read = [], array $write = [], float $timeout = -1): Coroutine
    {
        OpenSwoole\Coroutine::select($read, $write, $timeout);
        return $this;
    }

    public function map(array $list, callable $fn, float $timeout = -1): Coroutine
    {
        OpenSwoole\Coroutine::map($list, $fn, $timeout);
        return $this;
    }
}