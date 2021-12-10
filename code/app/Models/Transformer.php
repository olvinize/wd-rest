<?php

namespace App\Models;

abstract class Transformer
{
    public static function getValidationRules(): array
    {
        return [
            'lang' => 'required|in:lat,eng',
            'n' => 'required|numeric|between:0,9999'
        ];
    }

    public static function create(string $language): ?NumberTransformerInterface
    {
        $transformers = [
            'eng' => EnglishTransformer::class,
            'lat' => LatvianTransformer::class
        ];
        return isset($transformers[$language]) ? new $transformers[$language]() : null;
    }
}
