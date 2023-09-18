<?php

namespace App\Http\Controllers\Admin;

use LowB\Ladmin\Controllers\CrudController;
use LowB\Ladmin\Fields\Show\ShowField;

class PostCrudController extends CrudController
{
    public function showFields(): array
    {
        return [
            ShowField::column('title')->setLabel('タイトル'),
            ShowField::column('content')
        ];
    }

    public function detailFields(): array
    {
        return [];
    }

    public function editorFields(): array
    {
        return [];
    }
}
