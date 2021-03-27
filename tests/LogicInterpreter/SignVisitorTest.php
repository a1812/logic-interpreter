<?php

namespace A1812\Tests\LogicInterpreter;

use A1812\LogicInterpreter\AndExp;
use A1812\LogicInterpreter\EquivalentExp;
use A1812\LogicInterpreter\ImplicationExp;
use A1812\LogicInterpreter\NotExp;
use A1812\LogicInterpreter\OrExp;
use A1812\LogicInterpreter\PeirceExp;
use A1812\LogicInterpreter\ShefferExp;
use A1812\LogicInterpreter\VariableExp;
use A1812\LogicInterpreter\Visitor\SignVisitor;
use A1812\LogicInterpreter\XorExp;
use PHPUnit\Framework\TestCase;

class SignVisitorTest extends TestCase
{
    public function providerVariables(): array
    {
        return [
            [
                new VariableExp('A'),
                new VariableExp('B')
            ],
        ];
    }

    /**
     * @dataProvider providerVariables
     */
    public function testOr($a, $b)
    {
        $exp    = new OrExp($a, $b);
        $result = $exp->accept(new SignVisitor());

        $this->assertEquals('(A ∨ B)', $result, 'должно быть "(A ∨ B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testAnd($a, $b)
    {
        $exp    = new AndExp($a, $b);
        $result = $exp->accept(new SignVisitor());

        $this->assertEquals('(A ∧ B)', $result, 'должно быть "(A ∧ B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testNot($a)
    {
        $exp    = new NotExp($a);
        $result = $exp->accept(new SignVisitor());

        $this->assertEquals('(~ A)', $result, 'должно быть "(~ A)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testXor($a, $b)
    {
        $exp    = new XorExp($a, $b);
        $result = $exp->accept(new SignVisitor());

        $this->assertEquals('(A ⊻ B)', $result, 'должно быть "(A ⊻ B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testImplication($a, $b)
    {
        $exp    = new ImplicationExp($a, $b);
        $result = $exp->accept(new SignVisitor());

        $this->assertEquals('(A → B)', $result, 'должно быть "(A → B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testEquivalence($a, $b)
    {
        $exp    = new EquivalentExp($a, $b);
        $result = $exp->accept(new SignVisitor());

        $this->assertEquals('(A ↔ B)', $result, 'должно быть "(A ↔ B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testSheffer($a, $b)
    {
        $exp    = new ShefferExp($a, $b);
        $result = $exp->accept(new SignVisitor());

        $this->assertEquals('(A | B)', $result, 'должно быть "(A | B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testPeirce($a, $b)
    {
        $exp    = new PeirceExp($a, $b);
        $result = $exp->accept(new SignVisitor());

        $this->assertEquals('(A ↓ B)', $result, 'должно быть "(A ↓ B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testCombination($a, $b)
    {
        $exp = new AndExp(
            $a,
            new OrExp($b,
                new NotExp($a)
            )
        );

        $result = $exp->accept(new SignVisitor());

        $this->assertEquals('(A ∧ (B ∨ (~ A)))', $result, 'должно быть "(A ∧ (B ∨ (~ A)))"');
    }
}
