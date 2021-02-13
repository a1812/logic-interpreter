<?php

namespace Logic\Interpreter;

class ImplicationExp extends AbstractExp
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
        return (bool)($this->first->interpret($context) && !$this->second->interpret($context))
            ? false
            : true;
    }
}
