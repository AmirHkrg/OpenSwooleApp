<?php

class CoChannel extends OpenswooleApp{
    private mixed $SERVER;

    public function newChannel(int $capacity = 1): CoChannel
    {
        $this->SERVER = new OpenSwoole\Coroutine\Channel($capacity);
        return $this;
    }

    public function push(mixed $data, float $timeout = -1): CoChannel
    {
        $this->SERVER->push($data, $timeout);
        return $this;
    }

    public function pop(float $timeout = -1): CoChannel
    {
        $this->SERVER->pop($timeout);
        return $this;
    }

    public function close(): CoChannel
    {
        $this->SERVER->close();
        return $this;
    }

    public function stats(): CoChannel
    {
        $this->SERVER->stats();
        return $this;
    }

    public function length(): CoChannel
    {
        $this->SERVER->length();
        return $this;
    }

    public function isEmpty(): CoChannel
    {
        $this->SERVER->isEmpty();
        return $this;
    }

    public function isFull(): CoChannel
    {
        $this->SERVER->isFull();
        return $this;
    }

    public function getId(): CoChannel
    {
        $this->SERVER->getId();
        return $this;
    }
}