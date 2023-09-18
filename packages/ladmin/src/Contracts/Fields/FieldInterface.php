<?php

namespace LowB\Ladmin\Contracts\Fields;

use LowB\Ladmin\Fields\BelongsTo;
use LowB\Ladmin\Fields\Column;

interface FieldInterface
{
    public static function column(string $columnName): Column;

    public static function belongsTo(string $columnName, string $belongsTo): BelongsTo;
}
