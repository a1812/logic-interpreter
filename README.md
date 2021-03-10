# logic-interpreter

## Install
```bash
$ composer require a1812/logic-interpreter
```

## Usage
``` php
namespace App;

use A1812\LogicInterpreter\AndExp;
use A1812\LogicInterpreter\Context;
use A1812\LogicInterpreter\ImplicationExp;
use A1812\LogicInterpreter\NotExp;
use A1812\LogicInterpreter\VariableExp;
use A1812\LogicInterpreter\Visitor\StringVisitor;

require 'vendor/autoload.php';

$context = new Context();

$a = new VariableExp('A');
$b = new VariableExp('B');

/*
 * NOT((A → B) AND (B → A))
 *
 * from https://logic-proof.io/186
 *
 * Case A  B  ~ ((A → B) ∧ (B → A))
 * 1    T  T  F
 * 2    T  F  T
 * 3    F  T  T
 * 4    F  F  F 
 */

$exp = new NotExp(
    new AndExp(
        new ImplicationExp($a, $b),
        new ImplicationExp($b, $a)
    )
);

$context->assign($a, true);
$context->assign($b, false);

// output: (NOT ((A IMPLICATION B) AND (B IMPLICATION A))) - true
echo $exp->accept(new StringVisitor()) . ' - ' . ($exp->interpret($context) ? 'true' : 'false') . PHP_EOL;

$context->assign($a, true);
$context->assign($b, true);

// output: (NOT ((A IMPLICATION B) AND (B IMPLICATION A))) - false
echo $exp->accept(new StringVisitor()) . ' - ' . ($exp->interpret($context) ? 'true' : 'false') . PHP_EOL;

```

## test

``` bash
$ php ./vendor/bin/phpunit --testdox
```
