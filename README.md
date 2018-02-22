# Request handler decorators

This package provides **[Psr-15](https://www.php-fig.org/psr/psr-15/)** request handler decorators.

**Require** php >= 7.1

**Installation** `composer require ellipse/handlers`

**Run tests** `./vendor/bin/kahlan`

- [Request handler with middleware](https://github.com/ellipsephp/handlers#request-handler-with-middleware)
- [Request handler with middleware stack](https://github.com/ellipsephp/handlers#request-handler-with-middleware-stack)
- [Request handler with middleware queue](https://github.com/ellipsephp/handlers#request-handler-with-middleware-queue)

## Request handler with middleware

This package provides a `Ellipse\Handlers\RequestHandlerWithMiddleware` class allowing to wrap a middleware around a request handler.

```php
<?php

namespace App;

use Ellipse\Handlers\RequestHandlerWithMiddleware;

// create Psr-15 middleware and request handler.
$middleware = new SomeMiddleware;
$handler = new SomeHandler;

// Wrap the middleware around the request handler.
$decorated = new RequestHandlerWithMiddleware($handler, $middleware);

// The request goes through the middleware then hit the request handler.
$response = $decorated->handle($request);
```

## Request handler with middleware stack

This package provides a `Ellipse\Handlers\RequestHandlerWithMiddlewareStack` class allowing to wrap many middleware around a request handler in LIFO order.

```php
<?php

namespace App;

use Ellipse\Handlers\RequestHandlerWithMiddlewareStack;

// create Psr-15 middleware and request handler.
$middleware1 = new SomeMiddleware1;
$middleware2 = new SomeMiddleware2;
$handler = new SomeHandler;

// Wrap the middleware around the request handler in LIFO order.
$decorated = new RequestHandlerWithMiddlewareStack($handler, [
    $middleware2,
    $middleware1,
]);

// The request goes through middleware1, middleware2, then hit the request handler.
$response = $decorated->handle($request);
```

## Request handler with middleware queue

This package provides a `Ellipse\Handlers\RequestHandlerWithMiddlewareQueue` class allowing to wrap many middleware around a request handler in FIFO order.

```php
<?php

namespace App;

use Ellipse\Handlers\RequestHandlerWithMiddlewareQueue;

// create Psr-15 middleware and request handler.
$middleware1 = new SomeMiddleware1;
$middleware2 = new SomeMiddleware2;
$handler = new SomeHandler;

// Wrap the middleware around the request handler in FIFO order.
$decorated = new RequestHandlerWithMiddlewareQueue($handler, [
    $middleware1,
    $middleware2,
]);

// The request goes through middleware1, middleware2, then hit the request handler.
$response = $decorated->handle($request);
```
