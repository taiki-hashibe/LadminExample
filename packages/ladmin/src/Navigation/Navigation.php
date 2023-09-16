<?php

namespace LowB\Ladmin\Navigation;

use LowB\Ladmin\Crud\Crud;

class Navigation
{
    public array $dropdown = [];
    public array $headerNavigation = [];
    public array $footerNavigation = [];

    public function addDropdown(Crud $menu)
    {
        array_push($this->dropdown, $menu);
    }

    public function removeDropdown(Crud $menu)
    {
        array_push($this->dropdown, $menu);
    }

    public function getDropdown()
    {
        return $this->dropdown;
    }

    public function addHeaderNavigation(Crud $navigation)
    {
        array_push($this->headerNavigation, $navigation);
    }

    public function removeHeaderNavigation(Crud $navigation)
    {
        $this->headerNavigation = array_filter($this->headerNavigation, function ($item) use ($navigation) {
            return !($item === $navigation);
        });
    }

    public function getHeaderNavigation()
    {
        return $this->headerNavigation;
    }

    public function addFooterNavigation(Crud $navigation)
    {
        array_push($this->footerNavigation, $navigation);
    }

    public function addRemoveNavigation(Crud $navigation)
    {
        array_push($this->footerNavigation, $navigation);
    }

    public function getFooterNavigation()
    {
        return $this->footerNavigation;
    }
}
