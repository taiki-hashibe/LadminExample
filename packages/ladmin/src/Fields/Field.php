<?php

namespace LowB\Ladmin\Fields;

abstract class Field
{
    protected string $view = 'ladmin::fields.show.default';

    protected string $columnName;

    protected string $label;

    public function __construct(string $columnName, string $view)
    {
        $this->columnName = $columnName;
        $this->label = $columnName;
        $this->view = $view;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue($model): mixed
    {
        return $model->{$this->columnName};
    }

    public function setView(string $view): self
    {
        $this->view = $view;
        return $this;
    }

    public function getView($model)
    {
        $label = $this->getLabel();
        $value = $this->getValue($model);

        return view($this->view, [
            'label' => $label,
            'value' => $value,
        ]);
    }
}
