<?php

namespace LowB\Ladmin\Contracts\Crud;

use Illuminate\Database\Eloquent\Model;

interface CrudInterface
{
    public function model(Model $model, array $config): self;

    public function crud(): self;

    public function show(): self;

    public function detail(): self;
}
