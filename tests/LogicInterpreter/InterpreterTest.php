<?php

namespace A1812\Tests\LogicInterpreter;

use A1812\LogicInterpreter\AndExp;
use A1812\LogicInterpreter\Context;
use A1812\LogicInterpreter\EquivalentExp;
use A1812\LogicInterpreter\ImplicationExp;
use A1812\LogicInterpreter\NotExp;
use A1812\LogicInterpreter\OrExp;
use A1812\LogicInterpreter\PeirceExp;
use A1812\LogicInterpreter\ShefferExp;
use A1812\LogicInterpreter\VariableExp;
use A1812\LogicInterpreter\Visitor\StringVisitor;
use A1812\LogicInterpreter\XorExp;
use PHPUnit\Framework\TestCase;

class InterpreterTest extends TestCase
{
    public function testOr()
    {
        $context = new Context();

        $a = new VariableExp('A');
        $b = new VariableExp('B');
        $c = new VariableExp('C');

        // A ∨ (B ∨ C)
        $exp = new OrExp(
            $a,
            new OrExp($b, $c)
        );

        $context->assign($a, false);
        $context->assign($b, true);
        $context->assign($c, false);

        $result = $exp->interpret($context);

        $this->assertTrue($result, 'A ∨ (B ∨ C) должен быть true');
    }

    public function testAnd()
    {
        $context = new Context();

        $a = new VariableExp('A');
        $b = new VariableExp('B');
        $c = new VariableExp('C');

        // A ∧ (B ∧ C)
        $exp = new AndExp(
            $a,
            new AndExp($b, $c)
        );

        $context->assign($a, true);
        $context->assign($b, true);
        $context->assign($c, true);

        $result = $exp->interpret($context);

        $this->assertTrue($result, 'A ∨ (B ∨ C) должен быть true');
    }

    public function testNot()
    {
        $context = new Context();

        $a = new VariableExp('A');

        // ~A
        $exp = new NotExp($a);

        $context->assign($a, false);
        $result = $exp->interpret($context);

        $this->assertTrue($result, '~A должен быть true');
    }

    public function testXor()
    {
        $context = new Context();

        $a = new VariableExp('A');
        $b = new VariableExp('B');

        // A ⊻ B
        $exp = new XorExp($a, $b);

        $context->assign($a, true);
        $context->assign($b, true);
        $result = $exp->interpret($context);

        $this->assertFalse($result, 'A ⊻ B должен быть false');
    }

    public function testImplication()
    {
        $context = new Context();

        $a = new VariableExp('A');
        $b = new VariableExp('B');

        // A → B
        $exp = new ImplicationExp($a, $b);

        $context->assign($a, true);
        $context->assign($b, false);
        $result = $exp->interpret($context);

        $this->assertFalse($result, 'A → B должен быть false');
    }

    public function testEquivalent()
    {
        $context = new Context();

        $a = new VariableExp('A');
        $b = new VariableExp('B');

        // A ↔ B
        $exp = new EquivalentExp($a, $b);

        $context->assign($a, true);
        $context->assign($b, true);

        $result = $exp->interpret($context);

        $this->assertTrue($result, 'A ↔ B должен быть true');
    }

    public function testSheffer()
    {
        $context = new Context();

        $a = new VariableExp('A');
        $b = new VariableExp('B');

        // A | B
        $exp = new ShefferExp($a, $b);

        $context->assign($a, false);
        $context->assign($b, false);

        $result = $exp->interpret($context);

        $this->assertTrue($result, 'A | B должен быть true');
    }

    public function testPirsa()
    {
        $context = new Context();

        $a = new VariableExp('A');
        $b = new VariableExp('B');

        // A ↓ B
        $exp = new PeirceExp($a, $b);

        $context->assign($a, true);
        $context->assign($b, true);

        $result = $exp->interpret($context);

        $this->assertFalse($result, 'A ↓ B должен быть false');
    }
}
