<?php

namespace LowB\Ladmin\Fields\Detail;

use LowB\Ladmin\Contracts\Fields\FieldInterface;
use LowB\Ladmin\Fields\BelongsTo;
use LowB\Ladmin\Fields\Column;

class DetailField implements FieldInterface
{
    protected static string $view = 'ladmin::fields.detail.default';

    public static function column(string $columnName): Column
    {
        return new Column($columnName, self::$view);
    }

    public static function belongsTo(string $columnName, string $belongsTo): BelongsTo
    {
        return new BelongsTo($columnName, $belongsTo, self::$view);
    }
}
