<?php

namespace Logic\Interpreter;

use Logic\Interpreter\Visitor\AbstractVisitor;

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
