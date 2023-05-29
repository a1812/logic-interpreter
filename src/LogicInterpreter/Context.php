<?php

namespace A1812\LogicInterpreter;

class Context
{
    private array $poolVariable;

    public function lookUp(string $name): bool
    {
        if (!key_exists($name, $this->poolVariable)) {
            throw new InterpreterContextException("No exist variable: $name");
        }

        return $this->poolVariable[$name];
    }

    public function assign(VariableExp $variable, bool $val): self
    {
        $this->poolVariable[$variable->getName()] = $val;

        return $this;
    }
}
