<?php

namespace LowB\Ladmin\Fields;

class BelongsTo extends Field
{
    protected $belongsTo;

    public function __construct(string $columnName, string $belongsTo)
    {
        parent::__construct($columnName);
        $this->belongsTo = $belongsTo;
    }

    public function getValue($model): mixed
    {
        return $model->{$this->columnName}->{$this->belongsTo};
    }
}
