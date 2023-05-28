<?php

namespace A1812\LogicInterpreter\Visitor;

use A1812\LogicInterpreter\AbstractExp;

class SignVisitor extends AbstractVisitor
{
    public function visitVariable(AbstractExp $exp): string
    {
        return $exp->getName();
    }

    public function visitAnd(AbstractExp $exp): string
    {
        return '('.$exp->getFirst()->accept($this).' ∧ '.$exp->getSecond()->accept($this).')';
    }

    public function visitOr(AbstractExp $exp): string
    {
        return '('.$exp->getFirst()->accept($this).' ∨ '.$exp->getSecond()->accept($this).')';
    }

    public function visitNot(AbstractExp $exp): string
    {
        return '(~ '.$exp->getFirst()->accept($this).')';
    }

    public function visitXor(AbstractExp $exp): string
    {
        return '('.$exp->getFirst()->accept($this).' ⊻ '.$exp->getSecond()->accept($this).')';
    }

    public function visitImplication(AbstractExp $exp): string
    {
        return '('.$exp->getFirst()->accept($this).' → '.$exp->getSecond()->accept($this).')';
    }

    public function visitEquivalence(AbstractExp $exp): string
    {
        return '('.$exp->getFirst()->accept($this).' ↔ '.$exp->getSecond()->accept($this).')';
    }

    public function visitSheffer(AbstractExp $exp): string
    {
        return '('.$exp->getFirst()->accept($this).' | '.$exp->getSecond()->accept($this).')';
    }

    public function visitPeirce(AbstractExp $exp): string
    {
        return '('.$exp->getFirst()->accept($this).' ↓ '.$exp->getSecond()->accept($this).')';
    }
}
