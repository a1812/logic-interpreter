<?php

namespace A1812\LogicInterpreter;

use A1812\LogicInterpreter\Visitor\AbstractVisitor;

class VariableExp extends AbstractExp
{
    public function __construct(private string $name)
    {
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
