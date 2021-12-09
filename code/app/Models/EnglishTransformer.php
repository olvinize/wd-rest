<?php

namespace App\Models;

use NumberToWords\NumberToWords;
use NumberToWords\NumberTransformer\NumberTransformer;

class EnglishTransformer implements NumberTransformerInterface
{
    private NumberTransformer $transformer;

    /**
     * @throws \NumberToWords\Exception\InvalidArgumentException
     */
    public function __construct()
    {
        $numberToWords = new NumberToWords();
        $this->transformer = $numberToWords->getNumberTransformer('en');
    }

    /**
     * @throws \NumberToWords\Exception\NumberToWordsException
     */
    public function translate(int $number): string
    {
        return $this->transformer->toWords($number);
    }
}
