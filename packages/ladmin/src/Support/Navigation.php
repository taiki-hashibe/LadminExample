<?php

namespace LowB\Ladmin\Support;

use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\Support\Facades\View;
use LowB\Ladmin\Contracts\Renderable;
use LowB\Ladmin\Route\Facades\LadminRoute;

class Navigation implements Renderable
{
    public string $label;
    public string $uri;
    public string $name;
    public string $view = 'ladmin::navigation.default';

    public function __construct(string $label, string $uri, string $name, ?string $view = null)
    {
        $this->label = $label;
        $this->uri = $uri;
        $this->name = $name;
        if ($view) {
            $this->view = $view;
        }
    }

    public function setView(string $view): self
    {
        $this->view = $view;
        return $this;
    }

    public function isActive(): bool
    {
        $currentRoute = LadminRoute::getCurrentRoute();
        if (!$currentRoute) {
            return false;
        }
        return $this->name === $currentRoute->route->action['as'];
    }

    public function toArray()
    {
        return [
            'label' => $this->label,
            'uri' => $this->uri,
            'name' => $this->name,
        ];
    }

    public function render(?array $params = []): ContractsView
    {
        return View::first([$this->view], [
            'navigation' => $this,
            'params' => $params
        ]);
    }
}
