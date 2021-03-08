# logic-interpreter

## Install
```bash
$ composer require a1812/logic-interpreter
```

## Usage
``` php
namespace App;

use Logic\Interpreter\Context;
use Logic\Interpreter\OrExp;
use Logic\Interpreter\VariableExp;
use Logic\Interpreter\Visitor\StringVisitor;

require 'vendor/autoload.php';

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

// (A OR (B OR C)) = true
echo $exp->accept(new StringVisitor()) . ' = ' . ($exp->interpret($context) ? 'true' : 'false') . PHP_EOL;
```

## test

``` bash
$ php ./vendor/bin/phpunit --testdox
```
