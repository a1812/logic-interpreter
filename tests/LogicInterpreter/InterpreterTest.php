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
use A1812\LogicInterpreter\XorExp;
use PHPUnit\Framework\TestCase;

class InterpreterTest extends TestCase
{
    public static Context $context;
    public static VariableExp $a;
    public static VariableExp $b;
    public static VariableExp $c;

    public static function setUpBeforeClass(): void
    {
        self::$context = new Context();

        self::$a = new VariableExp('A');
        self::$b = new VariableExp('B');
        self::$c = new VariableExp('C');
    }

    public function testOr()
    {
        // A ∨ (B ∨ C)
        $exp = new OrExp(
            self::$a,
            new OrExp(self::$b, self::$c)
        );

        self::$context
            ->assign(self::$a, false)
            ->assign(self::$b, true)
            ->assign(self::$c, false)
        ;

        $result = $exp->interpret(self::$context);

        $this->assertTrue($result, 'A ∨ (B ∨ C) должен быть true');
    }

    public function testAnd()
    {
        // A ∧ (B ∧ C)
        $exp = new AndExp(
            self::$a,
            new AndExp(self::$b, self::$c)
        );

        self::$context
            ->assign(self::$a, true)
            ->assign(self::$b, true)
            ->assign(self::$c, true)
        ;

        $result = $exp->interpret(self::$context);

        $this->assertTrue($result, 'A ∨ (B ∨ C) должен быть true');
    }

    public function testNot()
    {
        // ~A
        $exp = new NotExp(self::$a);

        self::$context->assign(self::$a, false);
        $result = $exp->interpret(self::$context);

        $this->assertTrue($result, '~A должен быть true');
    }

    public function testXor()
    {
        // A ⊻ B
        $exp = new XorExp(self::$a, self::$b);

        self::$context
            ->assign(self::$a, true)
            ->assign(self::$b, true)
        ;

        $result = $exp->interpret(self::$context);

        $this->assertFalse($result, 'A ⊻ B должен быть false');
    }

    public function testImplication()
    {
        // A → B
        $exp = new ImplicationExp(self::$a, self::$b);

        self::$context
            ->assign(self::$a, true)
            ->assign(self::$b, false)
        ;

        $result = $exp->interpret(self::$context);

        $this->assertFalse($result, 'A → B должен быть false');
    }

    public function testEquivalent()
    {
        // A ↔ B
        $exp = new EquivalentExp(self::$a, self::$b);

        self::$context
            ->assign(self::$a, true)
            ->assign(self::$b, true)
        ;

        $result = $exp->interpret(self::$context);

        $this->assertTrue($result, 'A ↔ B должен быть true');
    }

    public function testSheffer()
    {
        // A | B
        $exp = new ShefferExp(self::$a, self::$b);

        self::$context
            ->assign(self::$a, false)
            ->assign(self::$b, false)
        ;

        $result = $exp->interpret(self::$context);

        $this->assertTrue($result, 'A | B должен быть true');
    }

    public function testPeirce()
    {
        // A ↓ B
        $exp = new PeirceExp(self::$a, self::$b);

        self::$context
            ->assign(self::$a, true)
            ->assign(self::$b, true)
        ;

        $result = $exp->interpret(self::$context);

        $this->assertFalse($result, 'A ↓ B должен быть false');
    }
}
