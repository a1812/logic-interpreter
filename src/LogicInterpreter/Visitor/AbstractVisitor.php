<?php

namespace A1812\LogicInterpreter\Visitor;

use A1812\LogicInterpreter\AbstractExp;

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
