<?php

namespace Logic\Interpreter;

class XorExp extends AbstractExp
{
    private AbstractExp $first;
    private AbstractExp $second;

    public function __construct(AbstractExp $first, AbstractExp $second)
    {
        $this->first = $first;
        $this->second = $second;
    }

    function interpret(Context $context): bool
    {
        return $this->first->interpret($context) xor $this->second->interpret($context);
    }
}
