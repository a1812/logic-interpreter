<?php

namespace A1812\LogicInterpreter;

interface BinaryInterface
{
    public function getFirst(): AbstractExp;

    public function getSecond(): AbstractExp;
}
