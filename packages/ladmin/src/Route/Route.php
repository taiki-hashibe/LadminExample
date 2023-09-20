<?php

namespace LowB\Ladmin\Route;

use Illuminate\Support\Facades\Route as FacadesRoute;

class Route
{
    protected mixed $route = null;
    protected string $label = '';
    protected array $navigation = [];

    public function __call($method, $args): self
    {
        dump($method);
        if ($this->route) {
            $this->route->{$method}(...$args);
        } else {
            $this->route = FacadesRoute::{$method}(...$args);
        }
        return $this;
    }

    public static function make(mixed $route): self
    {
        dd($route);
        return new self($route);
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

    public function setNavigation(array $navigation): self
    {
        $this->navigation = $navigation;
        return $this;
    }

    public function addNavigation(string $navigation): self
    {
        $this->navigation[] = $navigation;
        return $this;
    }

    public function getNavigation(): array
    {
        return $this->navigation;
    }
}
