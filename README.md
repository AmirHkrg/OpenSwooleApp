# OpenSwoole
- Chain Methode
- Clean Code
- Easy To Use
- Faster
---
### *You can use chain methode.*
```php
$server->Http()->end()->start();
```
---
### *Easier to use and requires less coding.*
The two codes below do the same thing. Compare them.
###### Original version :
```php
use OpenSwoole\Http\Server;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;

$server = new OpenSwoole\HTTP\Server("127.0.0.1", 9501);

$server->on("start", function (Server $server) {
    echo "Server Started";
});

$server->on("request", function (Request $request, Response $response) {
    $response->header("Content-Type", "text/plain");
    $response->end('Hello, OpenSwoole');
});

$server->start();
```
###### Optimized version in this repository :
```php
$server = new OpenswooleApp('127.0.0.1', 9501);

$server->Http()->serverOnStart(function (){
    echo "Server Started";
})->end('Hello, OpenSwoole')->start();
```
---
### *Very easy to use.*
Just create an object from your server
```php
$server = new OpenswooleApp('127.0.0.1', 9501);
```
After this, you have access to all methods from `$server`

---
### *Much faster.*
### Cpu Core 2 , Ram 12Gb
###### Original version benchmark :
#### ~50Gb data Transfer
```text
Concurrency Level:      2
Time taken for tests:   318.888 seconds
Complete requests:      100000
Failed requests:        0
Total transferred:      51145000000 bytes
HTML transferred:       51131900000 bytes
Requests per second:    313.59 [#/sec] (mean)
Time per request:       6.378 [ms] (mean)
Time per request:       3.189 [ms] (mean, across all concurrent requests)
Transfer rate:          156626.51 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.0      0       1
Processing:     5    6   1.6      6     232
Waiting:        4    6   0.5      6      34
Total:          5    6   1.6      6     232

Percentage of the requests served within a certain time (ms)
  50%      6
  66%      6
  75%      7
  80%      7
  90%      7
  95%      7
  98%      7
  99%      8
 100%    232 (longest request)
```
###### Optimized version in this repository benchmark :
#### ~150Gb data Transfer
```text
Concurrency Level:      2
Time taken for tests:   138.908 seconds
Complete requests:      100000
Failed requests:        0
Total transferred:      143795700000 bytes
HTML transferred:       143782500000 bytes
Requests per second:    719.90 [#/sec] (mean)
Time per request:       2.778 [ms] (mean)
Time per request:       1.389 [ms] (mean, across all concurrent requests)
Transfer rate:          1010926.01 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.0      0       3
Processing:     1    3   1.0      3     228
Waiting:        0    1   0.3      1       4
Total:          2    3   1.0      3     228

Percentage of the requests served within a certain time (ms)
  50%      3
  66%      3
  75%      3
  80%      3
  90%      3
  95%      3
  98%      3
  99%      3
 100%    228 (longest request)
```

---
## Features list :
- `Http()`
- `UdpTcp()`
- `WebSocket()`
- `Timer()`
- `Event()`

By calling any of the above methods, you get access to all related methods.

---

### Setup Server :
```php
require_once '<OpenSwooleApp Folder>/loader.php'; // Require OpenSwooleApp

$server = new OpenswooleApp('127.0.0.1', 9501); // Create Server
```
---

### Example :
- #### Http Server Example
```php
$server = new OpenswooleApp("127.0.0.1", 9501);
    
$server
    ->Http() // Call Http Methode
    ->serverOnStart(function (){
    echo "Server Started";
    }) // = on('Start', <callable>)
    ->end('Hello, OpenSwoole') // = on('request', <callable>) -> end()
    ->start() // Start Server;
```
- #### UdpTcp Server Example
```php
$server = new OpenSwooleApp("127.0.0.1",
    9501, OpenSwoole\Server::SIMPLE_MODE, OpenSwoole\Constant::SOCK_TCP);
    
$server
    ->UdpTcp() // Call UdpTcp Methode
    ->set([
        'worker_num' => 4,
        'daemonize' => true,
        'backlog' => 128,
    ])
    ->on('connect', function() {
        // ...
    })
    ->on('receive', function() {
        // ...
    })
    ->on('close', function() {
        // ...
    });

```
- #### WebSocket Server Example
```php
$server = new OpenSwooleApp("0.0.0.0", 9501);

$server
    ->WebSocket() // Call WebSocket Methode
    ->serverOnStart(function (){
        echo "Server Started";
    })
    ->on('Open', function(OpenSwoole\WebSocket\Server $serv, OpenSwoole\Http\Request $request) use ($server){
        echo "connection open";

        $server->Timer()->tick(1000, function() use ($serv, $request){
            $serv->push($request->fd, json_encode(["hello", time()]));
        });
    })
    ->on('Message', function(OpenSwoole\WebSocket\Server $serv, Frame $frame) use ($server){
        echo "received message: {$frame->data}\n";
        $serv->push($frame->fd, json_encode(["hello", time()]));
    })
    ->on('Close', function(OpenSwoole\WebSocket\Server $serv, int $fd){
        echo "connection close: {$fd}\n";
    })
    ->on('Disconnect', function(OpenSwoole\WebSocket\Server $server, int $fd){
        echo "connection disconnect: {$fd}\n";
    })
    ->start();
```
- #### Event Example
```php
$server
    ->Event() // Call Event Methode
    ->wait();
echo " world\n";
```
- #### Timer Example
```php
$server
    ->Timer() // Call Timer Methode
    ->tick(3000, function () {
        echo "after 3000ms.\n";
    });
```
- #### Coroutine Example
###### Not the latest version! Change in the future ...
```php
$server
    ->Coroutine()
    ->run(function () use ($server){
        go(function() use ($server)
        {
            $server
            ->Coroutine()
            ->sleep(1);
            echo "Done 1\n";
        });

        go(function() use ($server)
        {
            $server
            ->Coroutine()
            ->sleep(1);
            echo "Done 2\n";
        });
    });
```
---

# *Updating ...*

### [WebSite](https://amirhkargar.ir) - [GitHub](https://github.com/AmirHkrg) - [Telegram](https://telegram.me/amirh_krgr)