<?php declare(strict_types=1);

namespace Ellipse\Handlers;

use Psr\Http\Server\RequestHandlerInterface;

class RequestHandlerWithMiddlewareQueue extends RequestHandlerWithMiddlewareStack
{
    /**
     * Set up a request handler with middleware queue with the given delegate
     * and the middleware queue wrapping it.
     *
     * @param \Psr\Http\Server\RequestHandlerInterface  $delegate
     * @param array                                     $middleware
     */
    public function __construct(RequestHandlerInterface $delegate, array $middleware)
    {
        parent::__construct($delegate, array_reverse($middleware));
    }
}
