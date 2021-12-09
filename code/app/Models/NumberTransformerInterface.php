<?php

namespace App\Models;

interface NumberTransformerInterface
{
    public function translate(int $number): string;
}
