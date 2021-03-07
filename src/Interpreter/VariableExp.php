<?php

namespace Logic\Interpreter;

use Logic\Interpreter\Visitor\AbstractVisitor;

class VariableExp extends AbstractExp
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    function accept(AbstractVisitor $visitor)
    {
        return $visitor->visitVariable($this);
    }
}
