<?php

namespace A1812\LogicInterpreter;

use A1812\LogicInterpreter\Visitor\AbstractVisitor;

abstract class AbstractExp
{
    abstract function interpret(Context $context): bool;

    abstract function accept(AbstractVisitor $visitor);
}
