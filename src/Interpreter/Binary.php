<?php

namespace Logic\Interpreter;

interface Binary
{
    public function getFirst(): AbstractExp;

    public function getSecond(): AbstractExp;
}
