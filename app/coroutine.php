<?php

class Coroutine extends OpenswooleApp{
    private mixed $SERVER;
    private mixed $CHANNEL = 1;

    public function __construct()
    {
        $this->createServer('OpenSwoole\Coroutine');
        global $server_config;
        $this->SERVER = $server_config['server'];
    }

    public function create(callable $callback, ...$params): Coroutine
    {
        function cosleep($second){
            co::sleep($second);
        }

        function coUsleep($microSecond){
            co::usleep($microSecond);
        }

        OpenSwoole\Coroutine::create($callback, $params);
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

    public function enableCoroutine (): Coroutine
    {
        OpenSwoole\Coroutine::enableCoroutine ();
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

    public function statvfs(string $path): Coroutine
    {
        OpenSwoole\Coroutine\System::statvfs($path);
        return $this;
    }

    public function wait(float $timeout = -1): Coroutine
    {
        OpenSwoole\Coroutine\System::wait($timeout);
        return $this;
    }

    public function waitPid(int $pid, float $timeout = -1): Coroutine
    {
        OpenSwoole\Coroutine\System::waitPid($pid, $timeout);
        return $this;
    }

    public function waitSignal(int $signalNum, float $timeout = -1): Coroutine
    {
        OpenSwoole\Coroutine\System::waitSignal($signalNum, $timeout);
        return $this;
    }

    public function waitEvent(mixed $resource, int $events = OpenSwoole\Constant::EVENT_READ, float $timeout = -1): Coroutine
    {
        OpenSwoole\Coroutine\System::waitEvent($resource, $events, $timeout);
        return $this;
    }

    public function newChannel(int $capacity = 1): Coroutine
    {
        $this->CHANNEL = new OpenSwoole\Coroutine\Channel($capacity);
        return $this;
    }

    public function push(mixed $data, float $timeout = -1): Coroutine
    {
       $this->CHANNEL->push($data, $timeout);
        return $this;
    }

    public function pop(float $timeout = -1): Coroutine
    {
        $this->CHANNEL->pop($timeout);
        return $this;
    }

    public function close(): Coroutine
    {
        $this->CHANNEL->close();
        return $this;
    }

    public function channelStats(): Coroutine
    {
        $this->CHANNEL->stats();
        return $this;
    }

    public function length(): Coroutine
    {
        $this->CHANNEL->length();
        return $this;
    }

    public function isEmpty(): Coroutine
    {
        $this->CHANNEL->isEmpty();
        return $this;
    }

    public function isFull(): Coroutine
    {
        $this->CHANNEL->isFull();
        return $this;
    }

    public function getId(): Coroutine
    {
        $this->CHANNEL->getId();
        return $this;
    }
}