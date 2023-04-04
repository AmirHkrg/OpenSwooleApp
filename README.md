# OpenSwoole
- Chain Methode
- Clean Code
- Easy To Use
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
$server = new OpenswooleApp('127.0.0.1', 9502);

$server->Http()->serverOnStart(function (){
    echo "Server Started";
})->end('Hello, OpenSwoole')->start();
```
---
### *Very easy to use.*
Just create an object from your server
```php
$server = new OpenswooleApp('127.0.0.1', 9502);
```
After this, you have access to all methods from `$server`

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

$server = new OpenswooleApp('127.0.0.1', 9502); // Create Server
```
---

### Example :
- #### Http Server Example
```php
$server = new OpenSwoole\Server("127.0.0.1", 9501);
    
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