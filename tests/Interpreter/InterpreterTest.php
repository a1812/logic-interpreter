<?php

namespace Logic\Tests\Interpreter;

use Logic\Interpreter\AndExp;
use Logic\Interpreter\Context;
use Logic\Interpreter\EquivalentExp;
use Logic\Interpreter\ImplicationExp;
use Logic\Interpreter\NotExp;
use Logic\Interpreter\OrExp;
use Logic\Interpreter\PeirceExp;
use Logic\Interpreter\ShefferExp;
use Logic\Interpreter\VariableExp;
use Logic\Interpreter\Visitor\StringVisitor;
use Logic\Interpreter\XorExp;
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
