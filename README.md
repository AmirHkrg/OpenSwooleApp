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
###### Original version benchmark :
```text
Concurrency Level:      1000
Time taken for tests:   255.025 seconds
Complete requests:      100000
Failed requests:        0
Total transferred:      51145000000 bytes
HTML transferred:       51131900000 bytes
Requests per second:    392.12 [#/sec] (mean)
Time per request:       2550.249 [ms] (mean)
Time per request:       2.550 [ms] (mean, across all concurrent requests)
Transfer rate:          195848.70 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    4  52.5      0    1073
Processing:    31 2544 397.6   2530    4926
Waiting:        9 2496 427.6   2504    4911
Total:         55 2548 405.8   2531    5111

Percentage of the requests served within a certain time (ms)
  50%   2531
  66%   2585
  75%   2632
  80%   2675
  90%   2877
  95%   3185
  98%   3737
  99%   3990
 100%   5111 (longest request)
```
###### Optimized version in this repository benchmark :
```text
Concurrency Level:      1000
Time taken for tests:   70.724 seconds
Complete requests:      100000
Failed requests:        0
Total transferred:      51144400000 bytes
HTML transferred:       51131900000 bytes
Requests per second:    1413.94 [#/sec] (mean)
Time per request:       707.244 [ms] (mean)
Time per request:       0.707 [ms] (mean, across all concurrent requests)
Transfer rate:          706201.42 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0   19   4.2     19      39
Processing:    23  688  52.5    687    1304
Waiting:        0   27  41.7     23     671
Total:         60  706  52.1    705    1323

Percentage of the requests served within a certain time (ms)
  50%    705
  66%    708
  75%    711
  80%    713
  90%    718
  95%    724
  98%    760
  99%    819
 100%   1323 (longest request)
```

---
## Features list :
- `Http()`
- `UdpTcp()`
- `WebSocket()`
- `Timer()`
- `Event()`
- `Coroutine()`  Not ready
- `CoSystem()` Not ready
- `CoChannel()` Not ready
- `CoWaitGroup()` Not ready
- `CoServer()` Not ready

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
---

# *Updating ...*

### [WebSite](https://amirhkargar.ir) - [GitHub](https://github.com/AmirHkrg) - [Telegram](https://telegram.me/amirh_krgr)