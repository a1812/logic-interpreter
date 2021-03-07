<?php

namespace Logic\Interpreter\Visitor;

use Logic\Interpreter\AbstractExp;

class StringVisitor extends AbstractVisitor
{
    public function visitVariable(AbstractExp $exp): string
    {
        return $exp->getName();
    }

    public function visitAnd(AbstractExp $exp): string
    {
        return '(' . $exp->getFirst()->accept($this)  . ' AND ' . $exp->getSecond()->accept($this) . ')';
    }

    public function visitOr(AbstractExp $exp): string
    {
        return '(' . $exp->getFirst()->accept($this)  . ' OR ' . $exp->getSecond()->accept($this) . ')';
    }

    public function visitNot(AbstractExp $exp): string
    {
        return '(NOT ' . $exp->getFirst()->accept($this) . ')';
    }

    public function visitImplication(AbstractExp $exp): string
    {
        return '(' . $exp->getFirst()->accept($this)  . ' IMPLICATION ' . $exp->getSecond()->accept($this) . ')';
    }

    public function visitEquivalence(AbstractExp $exp): string
    {
        return '(' . $exp->getFirst()->accept($this)  . ' EQUIVALENCE ' . $exp->getSecond()->accept($this) . ')';
    }

    public function visitSheffer(AbstractExp $exp): string
    {
        return '(' . $exp->getFirst()->accept($this)  . ' SHEFFER ' . $exp->getSecond()->accept($this) . ')';
    }

    public function visitPeirce(AbstractExp $exp): string
    {
        return '(' . $exp->getFirst()->accept($this)  . ' PEIRCE ' . $exp->getSecond()->accept($this) . ')';
    }
}
