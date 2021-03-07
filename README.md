# logic-interpreter

## Install
```bash
$ composer require a1812/logic-interpreter
```

## Usage
``` php
use Logic\Interpreter\Context;
use Logic\Interpreter\OrExp;
use Logic\Interpreter\VariableExp;

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

var_dump($exp->interpret($context));
```
