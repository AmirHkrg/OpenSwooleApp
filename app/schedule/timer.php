<?php

class Timer extends OpenswooleApp
{
    public function set(array $timerSettings): Timer
    {
        // This method has been deprecated at the version v22.0.0.
        OpenSwoole\Timer::set($timerSettings);
        return $this;
    }

    public function tick(int $interval_ms, callable $callback_function, mixed ...$params): Timer
    {
        OpenSwoole\Timer::tick($interval_ms, $callback_function, $params);
        return $this;
    }

    public function after(int $interval_ms, callable $callback_function, mixed ...$params): Timer
    {
        OpenSwoole\Timer::after($interval_ms, $callback_function, $params);
        return $this;
    }

    public function list(): Timer
    {
        OpenSwoole\Timer::list();
        return $this;
    }

    public function stats(): Timer
    {
        OpenSwoole\Timer::stats();
        return $this;
    }

    public function info(int $timerId): Timer
    {
        OpenSwoole\Timer::info($timerId);
        return $this;
    }

    public function exists(int $timerId): Timer
    {
        OpenSwoole\Timer::exists($timerId);
        return $this;
    }

    public function clear(int $timerId): Timer
    {
        OpenSwoole\Timer::clear($timerId);
        return $this;
    }

    public function clearAll(): Timer
    {
        OpenSwoole\Timer::clearAll();
        return $this;
    }
}