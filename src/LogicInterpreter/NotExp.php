<?php

namespace A1812\LogicInterpreter;

use A1812\LogicInterpreter\Visitor\AbstractVisitor;

class NotExp extends AbstractExp implements UnaryInterface
{
    private AbstractExp $first;

    public function __construct(AbstractExp $first)
    {
        $this->first = $first;
    }

    public function getFirst(): AbstractExp
    {
        return $this->first;
    }

    function interpret(Context $context): bool
    {
        return !$this->first->interpret($context);
    }

    function accept(AbstractVisitor $visitor)
    {
        return $visitor->visitNot($this);
    }
}
