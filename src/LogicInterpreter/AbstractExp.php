<?php

namespace A1812\LogicInterpreter;

use A1812\LogicInterpreter\Visitor\AbstractVisitor;

abstract class AbstractExp
{
    abstract public function interpret(Context $context): bool;

    abstract public function accept(AbstractVisitor $visitor);
}
