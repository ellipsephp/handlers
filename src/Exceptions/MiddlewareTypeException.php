<?php declare(strict_types=1);

namespace Ellipse\Handlers\Exceptions;

use TypeError;

use Psr\Http\Server\MiddlewareInterface;

class MiddlewareTypeException extends TypeError implements RequestHandlerExceptionInterface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;

        $template = "Trying to use a value of type %s as middleware - object implementing %s expected";

        $type = is_object($value) ? get_class($value) : gettype($value);

        $msg = sprintf($template, $type, MiddlewareInterface::class);

        parent::__construct($msg);
    }

    public function value()
    {
        return $this->value;
    }
}
