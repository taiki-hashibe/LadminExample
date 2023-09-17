<?php

namespace LowB\Ladmin\Navigation;

use LowB\Ladmin\Crud\Crud;

class Navigation
{
    protected string $type = '';
    protected string $label = '';
    protected string $url = '';
    protected bool $active = false;
    protected array $target = [];
}
