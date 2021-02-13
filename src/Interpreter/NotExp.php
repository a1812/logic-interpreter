<?php

namespace Logic\Interpreter;

class NotExp extends AbstractExp
{
    private AbstractExp $first;

    public function __construct(AbstractExp $first)
    {
        $this->first = $first;
    }

    function interpret(Context $context): bool
    {
        return !$this->first->interpret($context);
    }
}
