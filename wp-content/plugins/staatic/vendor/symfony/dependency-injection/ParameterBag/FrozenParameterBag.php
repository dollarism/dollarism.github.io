<?php

namespace Staatic\Vendor\Symfony\Component\DependencyInjection\ParameterBag;

use UnitEnum;
use Staatic\Vendor\Symfony\Component\DependencyInjection\Exception\LogicException;
class FrozenParameterBag extends ParameterBag
{
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
        $this->resolved = \true;
    }
    public function clear()
    {
        throw new LogicException('Impossible to call clear() on a frozen ParameterBag.');
    }
    /**
     * @param mixed[] $parameters
     */
    public function add($parameters)
    {
        throw new LogicException('Impossible to call add() on a frozen ParameterBag.');
    }
    /**
     * @param string $name
     * @param mixed[]|bool|string|int|float|UnitEnum|null $value
     */
    public function set($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }
    /**
     * @param string $name
     */
    public function remove($name)
    {
        throw new LogicException('Impossible to call remove() on a frozen ParameterBag.');
    }
}
