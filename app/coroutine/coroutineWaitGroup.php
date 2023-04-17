<?php

class CoWaitGroup extends OpenswooleApp{
    private mixed $SERVER;

    public function newWaitGroup(): CoWaitGroup
    {
        $this->SERVER = new OpenSwoole\Core\Coroutine\WaitGroup();
        return $this;
    }

    public function add(int $count = 1): CoWaitGroup
    {
        $this->SERVER->add($count);
        return $this;
    }

    public function done(): CoWaitGroup
    {
        $this->SERVER->done();
        return $this;
    }

    public function wait(int $timeout = -1): CoWaitGroup
    {
        $this->SERVER->wait($timeout);
        return $this;
    }

    public function count(): CoWaitGroup
    {
        $this->SERVER->count();
        return $this;
    }

    public function batch(array $tasks, float $timeout = -1): CoWaitGroup
    {
        OpenSwoole\Coroutine\batch($tasks, $timeout);
        return $this;
    }

    public function isEmpty(int $n, callable $fn): CoWaitGroup
    {
        OpenSwoole\Coroutine\parallel($n, $fn);
        return $this;
    }
}