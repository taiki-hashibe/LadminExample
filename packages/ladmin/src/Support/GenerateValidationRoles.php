<?php

namespace LowB\Ladmin\Support;

class GenerateValidationRules
{
    protected function generate(\Doctrine\DBAL\Schema\Column $column): array
    {
        $rules = [];

        // Check for NOT NULL constraint
        if (!$column->getNotnull()) {
            $rules[] = 'nullable';
        }

        // Check for data type and add appropriate rules
        $type = $column->getType()->getTypeRegistry()->lookupName($column->getType());
        switch ($type) {
            case 'string':
                $rules[] = 'string';
                $rules[] = 'max:' . $column->getLength();
                break;
            case 'integer':
                $rules[] = 'integer';
                break;
            case 'float':
                $rules[] = 'numeric';
                $rules[] = 'between:' . (-10 ** 9) . ',' . (10 ** 9); // Example range
                break;
                // Add cases for other data types as needed
        }

        return $rules;
    }
}
