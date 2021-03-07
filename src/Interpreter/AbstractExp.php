<?php

namespace Logic\Interpreter;

use Logic\Interpreter\Visitor\AbstractVisitor;

abstract class AbstractExp
{
    abstract function interpret(Context $context): bool;

    abstract function accept(AbstractVisitor $visitor);
}
