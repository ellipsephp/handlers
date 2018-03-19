<?php declare(strict_types=1);

namespace Ellipse\Handlers\Exceptions;

use TypeError;

use Psr\Http\Server\MiddlewareInterface;

use Ellipse\Exceptions\TypeErrorMessage;

class MiddlewareTypeException extends TypeError implements RequestHandlerExceptionInterface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;

        $msg = new TypeErrorMessage('middleware', $value, MiddlewareInterface::class);

        parent::__construct((string) $msg);
    }

    public function value()
    {
        return $this->value;
    }
}
