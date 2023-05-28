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
use A1812\LogicInterpreter\Visitor\StringVisitor;
use A1812\LogicInterpreter\XorExp;
use PHPUnit\Framework\TestCase;

class StringVisitorTest extends TestCase
{
    public function providerVariables(): array
    {
        return [
            [
                new VariableExp('A'),
                new VariableExp('B'),
            ],
        ];
    }

    /**
     * @dataProvider providerVariables
     */
    public function testOr($a, $b)
    {
        $exp = new OrExp($a, $b);
        $result = $exp->accept(new StringVisitor());

        $this->assertEquals('(A OR B)', $result, 'должно быть "(A OR B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testAnd($a, $b)
    {
        $exp = new AndExp($a, $b);
        $result = $exp->accept(new StringVisitor());

        $this->assertEquals('(A AND B)', $result, 'должно быть "(A AND B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testNot($a)
    {
        $exp = new NotExp($a);
        $result = $exp->accept(new StringVisitor());

        $this->assertEquals('(NOT A)', $result, 'должно быть "(NOT A)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testXor($a, $b)
    {
        $exp = new XorExp($a, $b);
        $result = $exp->accept(new StringVisitor());

        $this->assertEquals('(A XOR B)', $result, 'должно быть "(A XOR B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testImplication($a, $b)
    {
        $exp = new ImplicationExp($a, $b);
        $result = $exp->accept(new StringVisitor());

        $this->assertEquals('(A IMPLICATION B)', $result, 'должно быть "(A IMPLICATION B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testEquivalence($a, $b)
    {
        $exp = new EquivalentExp($a, $b);
        $result = $exp->accept(new StringVisitor());

        $this->assertEquals('(A EQUIVALENCE B)', $result, 'должно быть "(A EQUIVALENCE B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testSheffer($a, $b)
    {
        $exp = new ShefferExp($a, $b);
        $result = $exp->accept(new StringVisitor());

        $this->assertEquals('(A SHEFFER B)', $result, 'должно быть "(A SHEFFER B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testPeirce($a, $b)
    {
        $exp = new PeirceExp($a, $b);
        $result = $exp->accept(new StringVisitor());

        $this->assertEquals('(A PEIRCE B)', $result, 'должно быть "(A PEIRCE B)"');
    }

    /**
     * @dataProvider providerVariables
     */
    public function testCombination($a, $b)
    {
        $exp = new AndExp(
            $a,
            new OrExp(
                $b,
                new NotExp($a)
            )
        );

        $result = $exp->accept(new StringVisitor());

        $this->assertEquals('(A AND (B OR (NOT A)))', $result, 'должно быть "(A AND (B OR (NOT A)))"');
    }
}
