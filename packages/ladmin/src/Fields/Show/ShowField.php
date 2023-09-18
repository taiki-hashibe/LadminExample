<?php

namespace LowB\Ladmin\Fields\Show;

use LowB\Ladmin\Fields\BelongsTo;
use LowB\Ladmin\Fields\Column;

class ShowField
{
    public static function column(string $columnName)
    {
        return new Column($columnName);
    }

    public static function belongsTo(string $columnName, string $belongsTo)
    {
        return new BelongsTo($columnName, $belongsTo);
    }
}
