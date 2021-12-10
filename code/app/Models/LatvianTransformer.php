<?php

namespace App\Models;

class LatvianTransformer implements NumberTransformerInterface
{
    public string $separator = ' ';
    public string $negative = 'minus ';
    private int $max = 1000000;
    private array $dictionary = array(
        0 => 'nulle',
        1 => 'viens',
        2 => 'divi',
        3 => 'trīs',
        4 => 'četri',
        5 => 'pieci',
        6 => 'seši',
        7 => 'septiņi',
        8 => 'astoņi',
        9 => 'deviņi',
        10 => 'desmit',
        11 => 'vienpadsmit',
        12 => 'divpadsmit',
        13 => 'trīspadsmit',
        14 => 'četrpadsmit',
        15 => 'piecpadsmit',
        16 => 'sešpadsmit',
        17 => 'septiņpadsmit',
        18 => 'astoņpadsmit',
        19 => 'deviņpadsmit',
        20 => 'divdesmit',
        30 => 'trīsdesmit',
        40 => 'četrdesmit',
        50 => 'piecdesmit',
        60 => 'sešdesmit',
        70 => 'septiņdesmit',
        80 => 'astoņdesmit',
        90 => 'deviņdesmit',
        100 => ['simts', 'simti'],
        1000 => ['tūkstotis', 'tūkstoši'],
        1000000 => ['miļjons', 'miļjoni'],
    );

    public function translate(int $number): string
    {
        return $this->spellNumber($number);
    }

    private function spellNumber(int $number): string
    {
        if ($number < -$this->max || $number > $this->max) {
            throw new \RuntimeException("Number must be between -{$this->max} and {$this->max}");
        }

        if ($number < 0) {
            return $this->negative . $this->spellNumber(abs($number));
        }

        $plural = false;
        $base = pow(1000, (int)((strlen($number) - 1) / 3));
        if ($base < 1000) { // 0 - 999
            $base = 100;
            $units = (int)($number / $base);
            if ($units) { // 100 - 999
                $remainder = $number % 100;
                $plural = $units > 1;
            } else { // 0-99
                $base = null;
                $units = $number < 21 ? $number : (int)($number / 10) * 10;
                $remainder = $number < 21 ? null : $number % 10;
            }
            $string = $this->spell($units) . ($base ? $this->separator . $this->spell($base, $plural) : '');
        } else { // >= 1000
            $units = (int)($number / $base);
            $plural = $units % 10 != 1 || $units % 100 == 11;
            $remainder = $number % $base;
            $string = $this->spellNumber($units) . ($base ? $this->separator . $this->spell($base, $plural) : '');
        }
        if ($remainder) {
            $string .= $this->separator . $this->spellNumber($remainder);
        }
        return $string;
    }

    private function spell(int $units, bool $plural = false): string
    {
        return is_array($this->dictionary[$units]) ? $this->dictionary[$units][$plural ? 1 : 0] : $this->dictionary[$units];
    }
}
