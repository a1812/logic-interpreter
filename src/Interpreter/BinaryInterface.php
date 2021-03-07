<?php

namespace Logic\Interpreter;

interface BinaryInterface
{
    public function getFirst(): AbstractExp;

    public function getSecond(): AbstractExp;
}
