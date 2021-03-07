<?php

namespace Logic\Interpreter;

use Logic\Interpreter\Visitor\AbstractVisitor;

class OrExp extends AbstractExp implements BinaryInterface
{
    private AbstractExp $first;
    private AbstractExp $second;

    public function __construct(AbstractExp $first, AbstractExp $second)
    {
        $this->first  = $first;
        $this->second = $second;
    }

    public function getFirst(): AbstractExp
    {
        return $this->first;
    }

    public function getSecond(): AbstractExp
    {
        return $this->second;
    }

    function interpret(Context $context): bool
    {
        return $this->first->interpret($context) || $this->second->interpret($context);
    }

    function accept(AbstractVisitor $visitor)
    {
        return $visitor->visitOr($this);
    }
}
