<?php

namespace Logic\Interpreter\Visitor;

use Logic\Interpreter\AbstractExp;

abstract class AbstractVisitor
{
    abstract public function visitAnd(AbstractExp $exp);
}
