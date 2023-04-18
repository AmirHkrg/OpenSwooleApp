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
Time taken for tests:   192.642 seconds
Complete requests:      100000
Failed requests:        0
Total transferred:      25548400000 bytes
HTML transferred:       25535300000 bytes
Requests per second:    519.10 [#/sec] (mean)
Time per request:       1926.425 [ms] (mean)
Time per request:       1.926 [ms] (mean, across all concurrent requests)
Transfer rate:          129512.52 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    3  51.9      0    1088
Processing:    46 1913 196.5   1879    3522
Waiting:       26 1912 196.4   1878    3521
Total:        110 1917 198.9   1880    3522

Percentage of the requests served within a certain time (ms)
  50%   1880
  66%   1896
  75%   1912
  80%   1923
  90%   2010
  95%   2130
  98%   2543
  99%   3011
 100%   3522 (longest request)
```
###### Optimized version in this repository benchmark :
```text
Concurrency Level:      1000
Time taken for tests:   28.996 seconds
Complete requests:      100000
Failed requests:        0
Total transferred:      25547800000 bytes
HTML transferred:       25535300000 bytes
Requests per second:    3448.78 [#/sec] (mean)
Time per request:       289.958 [ms] (mean)
Time per request:       0.290 [ms] (mean, across all concurrent requests)
Transfer rate:          860436.03 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0   16  52.4     13    1067
Processing:    33  274  23.9    274     552
Waiting:        1   17  20.7     15     326
Total:         55  290  60.0    287    1462

Percentage of the requests served within a certain time (ms)
  50%    287
  66%    289
  75%    291
  80%    292
  90%    296
  95%    299
  98%    325
  99%    352
 100%   1462 (longest request)
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