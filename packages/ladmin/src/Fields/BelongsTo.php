<?php

namespace LowB\Ladmin\Fields;

class BelongsTo extends Field
{
    protected $belongsTo;

    public function __construct(string $columnName, string $belongsTo, string $view)
    {
        parent::__construct($columnName, $view);
        $this->belongsTo = $belongsTo;
    }

    public function getValue(mixed $model): mixed
    {
        return $model->{$this->columnName}->{$this->belongsTo};
    }
}
