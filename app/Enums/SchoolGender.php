<?php

namespace App\Enums;

enum SchoolGender: string
{
    case Girls = 'girls';
    case Boys = 'boys';
    case Mixed = 'mixed';

    public function getLabel(): string
    {
        return match ($this) {
            self::Girls => 'Girls',
            self::Boys => 'Boys',
            self::Mixed => 'Mixed',
        };
    }
}
