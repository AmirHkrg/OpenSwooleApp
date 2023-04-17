<?php

class CoSystem extends OpenswooleApp{
    public function statvfs(string $path): CoSystem
    {
        OpenSwoole\Coroutine\System::statvfs($path);
        return $this;
    }

    public function readFile(string $filename): CoSystem
    {
        OpenSwoole\Coroutine\System::readFile($filename);
        return $this;
    }

    public function writeFile(string $filename, string $fileContent, int $flags): CoSystem
    {
        OpenSwoole\Coroutine\System::writeFile($filename, $fileContent, $flags);
        return $this;
    }

    public function sleep(int $seconds): CoSystem
    {
        OpenSwoole\Coroutine\System::sleep($seconds);
        return $this;
    }

    public function exec(string $cmd): CoSystem
    {
        OpenSwoole\Coroutine\System::exec($cmd);
        return $this;
    }

    public function gethostbyname(string $domain, int $family = AF_INET, float $timeout = -1): CoSystem
    {
        OpenSwoole\Coroutine\System::gethostbyname($domain, $family, $timeout);
        return $this;
    }

    public function getaddrinfo(string $domain, int $family = AF_INET, int $sockType = SOCK_STREAM, int $protocol = STREAM_IPPROTO_TCP, string $service = null, float $timeout = -1): CoSystem
    {
        OpenSwoole\Coroutine\System::gethostbyname($domain, $family, $sockType, $protocol, $service, $timeout);
        return $this;
    }

    public function dnsLookup(string $domain, float $timeout = 5): CoSystem
    {
        OpenSwoole\Coroutine\System::dnsLookup($domain, $timeout);
        return $this;
    }

    public function wait(float $timeout = -1): CoSystem
    {
        OpenSwoole\Coroutine\System::wait($timeout);
        return $this;
    }

    public function waitPid(int $pid, float $timeout = -1): CoSystem
    {
        OpenSwoole\Coroutine\System::waitPid($pid, $timeout);
        return $this;
    }

    public function waitSignal(int $signalNum, float $timeout = -1): CoSystem
    {
        OpenSwoole\Coroutine\System::waitSignal($signalNum, $timeout);
        return $this;
    }

    public function waitEvent(mixed $resource, int $events = OpenSwoole\Constant::EVENT_READ, float $timeout = -1): CoSystem
    {
        OpenSwoole\Coroutine\System::waitEvent($resource, $events, $timeout);
        return $this;
    }
}