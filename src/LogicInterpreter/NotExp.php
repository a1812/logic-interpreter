<?php

namespace A1812\LogicInterpreter;

use A1812\LogicInterpreter\Visitor\AbstractVisitor;

class NotExp extends AbstractExp implements UnaryInterface
{
    public function __construct(private AbstractExp $first)
    {
    }

    public function getFirst(): AbstractExp
    {
        return $this->first;
    }

    public function interpret(Context $context): bool
    {
        return !$this->first->interpret($context);
    }

    public function accept(AbstractVisitor $visitor)
    {
        return $visitor->visitNot($this);
    }
}
