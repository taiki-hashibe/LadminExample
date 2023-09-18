<?php

namespace LowB\Ladmin\Fields;

abstract class Field
{
    protected string $view = 'ladmin::fields.show.default';

    protected string $columnName;

    protected string $label;

    public function __construct(string $columnName)
    {
        $this->columnName = $columnName;
        $this->label = $columnName;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue($model): mixed
    {
        return $model->{$this->columnName};
    }

    public function setView(string $view): void
    {
        $this->view = $view;
    }

    public function getView($model)
    {
        $value = $this->getValue($model);

        return view($this->view, [
            'value' => $value,
        ]);
    }
}
