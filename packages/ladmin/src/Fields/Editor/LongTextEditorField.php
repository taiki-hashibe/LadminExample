<?php

namespace LowB\Ladmin\Fields\Editor;

use LowB\Ladmin\Contracts\Fields\FieldInterface;
use LowB\Ladmin\Fields\BelongsTo;
use LowB\Ladmin\Fields\Column;

class LongTextEditorField implements FieldInterface
{
    protected static string $view = 'fields.editor.textarea';

    public static function column(string $columnName): Column
    {
        return new Column($columnName, self::$view);
    }

    public static function belongsTo(string $columnName, string $belongsTo): BelongsTo
    {
        return new BelongsTo($columnName, $belongsTo, self::$view);
    }
}
