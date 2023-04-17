<?php

class Event extends OpenswooleApp
{
    public function set(int $fd, Mixed $read_callback, Mixed $write_callback, int $flags): Event
    {
        OpenSwoole\Event::set($fd, $read_callback, $write_callback, $flags);
        return $this;
    }

    public function add(Mixed $sock, callable $read_callback, callable $write_callback = null, int $flags = null): Event
    {
        OpenSwoole\Event::add($sock, $read_callback, $write_callback, $flags);
        return $this;
    }

    public function del(Mixed $sock): Event
    {
        OpenSwoole\Event::del($sock);
        return $this;
    }

    public function exit(): Event
    {
        OpenSwoole\Event::exit();
        return $this;
    }

    public function wait(): Event
    {
        OpenSwoole\Event::wait();
        return $this;
    }

    public function write(Mixed $fd, Mixed $data): Event
    {
        OpenSwoole\Event::write($fd, $data);
        return $this;
    }

    public function defer(callable $callback): Event
    {
        OpenSwoole\Event::defer($callback);
        return $this;
    }

    public function dispatch(): Event
    {
        OpenSwoole\Event::dispatch();
        return $this;
    }

    public function cycle(callable $callback, bool $before = false): Event
    {
        OpenSwoole\Event::cycle($callback, $before);
        return $this;
    }

    public function isset(mixed $fd, mixed $events = OpenSwoole\Socket::EVENT_READ | OpenSwoole\Socket::EVENT_WRITE): Event
    {
        /*
         * OpenSwoole\Socket::EVENT_READ  : 512
         * OpenSwoole\Socket::EVENT_WRITE : 1024
         */
        OpenSwoole\Event::isset($fd, $events);
        return $this;
    }
}