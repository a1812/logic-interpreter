<?php

namespace Logic\Interpreter;

class Context
{
    private array $poolVariable;

    function lookUp(string $name): bool
    {
        if (!key_exists($name, $this->poolVariable)) {
            throw new InterpreterContextException("No exist variable: $name");
        }

        return $this->poolVariable[$name];
    }

    function assign(VariableExp $variable, bool $val)
    {
        $this->poolVariable[$variable->getName()] = $val;
    }
}
