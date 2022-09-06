<?php

namespace App\Traits;

trait EnumToArrayTrait
{
    /**
     * Returns an enum's values as an array
     * @param $enum
     * @return array
     */
    public function getEnumValues($enum): array
    {
        return array_column($enum, 'value');
    }
}
