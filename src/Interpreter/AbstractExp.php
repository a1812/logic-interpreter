<?php

namespace Logic\Interpreter;

abstract class AbstractExp
{
    abstract function interpret(Context $context): bool;
}
