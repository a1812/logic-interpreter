<?php

namespace Logic\Interpreter\Visitor;

use Logic\Interpreter\AbstractExp;

abstract class AbstractVisitor
{
    abstract public function visitVariable(AbstractExp $exp);

    abstract public function visitAnd(AbstractExp $exp);

    abstract public function visitOr(AbstractExp $exp);

    abstract public function visitNot(AbstractExp $exp);

    abstract public function visitXor(AbstractExp $exp);

    abstract public function visitImplication(AbstractExp $exp);

    abstract public function visitEquivalence(AbstractExp $exp);

    abstract public function visitSheffer(AbstractExp $exp);

    abstract public function visitPeirce(AbstractExp $exp);
}
