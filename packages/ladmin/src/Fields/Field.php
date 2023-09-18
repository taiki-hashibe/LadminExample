<?php

namespace LowB\Ladmin\Fields;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

abstract class Field
{
    protected string $view = 'ladmin::fields.show.default';

    protected string $columnName;

    protected string $label;

    protected array $validation = [];

    public function __construct(string $columnName, string $view)
    {
        $this->columnName = $columnName;
        $this->label = $columnName;
        $this->view = $view;
    }

    public function getName(): string
    {
        return $this->columnName;
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

    public function setValidation(array $validation): self
    {
        $this->validation = $validation;
        return $this;
    }

    public function getValidation(): array
    {
        return $this->validation;
    }

    public function getView($model)
    {
        return View::first([$this->generateLocalViewName(), $this->view], [
            'field' => $this,
            'label' => $this->getLabel(),
            'name' => $this->columnName,
            'value' => $this->getValue($model),
        ]);
    }

    public function isRequired(): bool
    {
        return in_array('required', $this->validation);
    }

    private function generateLocalViewName()
    {
        return Str::replaceFirst('ladmin::', 'admin.', $this->view);
    }
}
