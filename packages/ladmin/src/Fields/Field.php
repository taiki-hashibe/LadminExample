<?php

namespace LowB\Ladmin\Fields;

use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Support\Facades\View;
use LowB\Ladmin\Config\Facades\LadminConfig;
use LowB\Ladmin\Facades\Ladmin;

abstract class Field
{
    const PREFIX = 'ladmin::';

    protected string $view = 'fields.show.default';

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

    public function getValue(mixed $model): mixed
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

    public function getView(mixed $model): ViewView
    {
        return View::first([$this->generateDetailedLocalViewName(), $this->generateLocalViewName(), LadminConfig::theme() . $this->view, self::PREFIX . $this->view], [
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

    private function generateDetailedLocalViewName(): string|null
    {
        if (Ladmin::crud() && Ladmin::crud()->tableName()) {
            return LadminConfig::localViewPrefix() . Ladmin::crud()->tableName() . '.' . $this->view;
        }
        return null;
    }

    private function generateLocalViewName(): string
    {
        return LadminConfig::localViewPrefix() . $this->view;
    }
}
