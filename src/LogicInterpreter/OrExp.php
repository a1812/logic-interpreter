<?php

namespace A1812\LogicInterpreter;

use A1812\LogicInterpreter\Visitor\AbstractVisitor;

class OrExp extends AbstractExp implements BinaryInterface
{
    public function __construct(private AbstractExp $first, private AbstractExp $second)
    {
    }

    public function getFirst(): AbstractExp
    {
        return $this->first;
    }

    public function getSecond(): AbstractExp
    {
        return $this->second;
    }

    public function interpret(Context $context): bool
    {
        return $this->first->interpret($context) || $this->second->interpret($context);
    }

    public function accept(AbstractVisitor $visitor)
    {
        return $visitor->visitOr($this);
    }
}
