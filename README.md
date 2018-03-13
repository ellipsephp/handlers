# Request handler decorators

This package provides [Psr-15](https://www.php-fig.org/psr/psr-15/) request handler decorators.

**Require** php >= 7.0

**Installation** `composer require ellipse/handlers`

**Run tests** `./vendor/bin/kahlan`

- [Fallback request handler](#fallback-request-handler)
- [Request handler with middleware](#request-handler-with-middleware)
- [Request handler with middleware stack](#request-handler-with-middleware-stack)
- [Request handler with middleware queue](#request-handler-with-middleware-queue)

## Fallback request handler

An usual starting point for request handler decorators is to have a request handler returning a default response when its `->handle()` method is called. This package provides an `Ellipse\Handlers\FallbackRequestHandler` class implementing this logic.

```php
<?php

namespace App;

use Ellipse\Handlers\FallbackRequestHandler;

// Get some fallback Psr-7 response, here with a 404 status code.
$response = some_psr7_response_factory()->withStatus(404);

// Create a fallback request handler returning the response.
$fallback = new FallbackRequestHandler($response);

// The response is returned.
$response = $fallback->handle($request);
```

## Request handler with middleware

This package provides an `Ellipse\Handlers\RequestHandlerWithMiddleware` class allowing to wrap a middleware around a request handler.

```php
<?php

namespace App;

use Ellipse\Handlers\FallbackRequestHandler;
use Ellipse\Handlers\RequestHandlerWithMiddleware;

// create Psr-15 middleware and request handler.
$middleware = new SomeMiddleware;
$handler = new FallbackRequestHandler($response);

// Wrap the middleware around the request handler.
$decorated = new RequestHandlerWithMiddleware($handler, $middleware);

// The request goes through the middleware then hit the fallback request handler.
$response = $decorated->handle($request);
```

## Request handler with middleware stack

This package provides an `Ellipse\Handlers\RequestHandlerWithMiddlewareStack` class allowing to wrap many middleware around a request handler in LIFO order.

```php
<?php

namespace App;

use Ellipse\Handlers\FallbackRequestHandler;
use Ellipse\Handlers\RequestHandlerWithMiddlewareStack;

// create Psr-15 middleware and request handler.
$middleware1 = new SomeMiddleware1;
$middleware2 = new SomeMiddleware2;
$handler = new FallbackRequestHandler($response);

// Wrap the middleware around the request handler in LIFO order.
$decorated = new RequestHandlerWithMiddlewareStack($handler, [
    $middleware2,
    $middleware1,
]);

// The request goes through middleware1, middleware2, then hit the fallback request handler.
$response = $decorated->handle($request);
```

## Request handler with middleware queue

This package provides an `Ellipse\Handlers\RequestHandlerWithMiddlewareQueue` class allowing to wrap many middleware around a request handler in FIFO order.

```php
<?php

namespace App;

use Ellipse\Handlers\FallbackRequestHandler;
use Ellipse\Handlers\RequestHandlerWithMiddlewareQueue;

// create Psr-15 middleware and request handler.
$middleware1 = new SomeMiddleware1;
$middleware2 = new SomeMiddleware2;
$handler = new FallbackRequestHandler($response);

// Wrap the middleware around the request handler in FIFO order.
$decorated = new RequestHandlerWithMiddlewareQueue($handler, [
    $middleware1,
    $middleware2,
]);

// The request goes through middleware1, middleware2, then hit the fallback request handler.
$response = $decorated->handle($request);
```
