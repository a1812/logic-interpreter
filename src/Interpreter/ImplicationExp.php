<?php

namespace Logic\Interpreter;

use Logic\Interpreter\Visitor\AbstractVisitor;

class ImplicationExp extends AbstractExp implements Binary
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
        return (bool)($this->first->interpret($context) && !$this->second->interpret($context))
            ? false
            : true;
    }

    function accept(AbstractVisitor $visitor)
    {
        return $visitor->visitImplication($this);
    }
}
