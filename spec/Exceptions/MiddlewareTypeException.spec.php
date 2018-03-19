<?php

use Ellipse\Handlers\Exceptions\RequestHandlerExceptionInterface;
use Ellipse\Handlers\Exceptions\MiddlewareTypeException;

describe('MiddlewareTypeException', function () {

    beforeEach(function () {

        $this->exception = new MiddlewareTypeException('invalid');

    });

    it('should extend TypeError', function () {

        expect($this->exception)->toBeAnInstanceOf(TypeError::class);

    });

    it('should implement RequestHandlerExceptionInterface', function () {

        expect($this->exception)->toBeAnInstanceOf(RequestHandlerExceptionInterface::class);

    });

    describe('->value()', function () {

        it('should return the value', function () {

            $test = $this->exception->value();

            expect($test)->toEqual('invalid');

        });

    });

});
