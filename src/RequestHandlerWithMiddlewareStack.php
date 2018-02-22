<?php declare(strict_types=1);

namespace Ellipse\Handlers;

use TypeError;

use Psr\Http\Server\RequestHandlerInterface;

use Ellipse\Handlers\Exceptions\MiddlewareTypeException;

class RequestHandlerWithMiddlewareStack extends AbstractDecoratedRequestHandler
{
    /**
     * Set up a request handler with middleware stack with the given delegate
     * and the middleware stack wrapping it.
     *
     * @param \Psr\Http\Server\RequestHandlerInterface  $delegate
     * @param array                                     $middleware
     * @throws \Ellipse\Handlers\Exceptions\MiddlewareTypeException
     */
    public function __construct(RequestHandlerInterface $delegate, array $middleware)
    {
        parent::__construct(array_reduce($middleware, function ($handler, $middleware) {

            try {

                return new RequestHandlerWithMiddleware($handler, $middleware);

            }

            catch (TypeError $e) {

                throw new MiddlewareTypeException($middleware);

            }

        }, $delegate));
    }
}
