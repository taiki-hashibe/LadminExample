<?php

namespace App\Http\Controllers\Admin;

use LowB\Ladmin\Controllers\CrudController;
use LowB\Ladmin\Fields\Show\ShowField;

class PostCrudController extends CrudController
{
    public function showFields()
    {
        return [
            ShowField::column('title')->setLabel('タイトル'),
            ShowField::column('content')
        ];
    }

    public function detailFields()
    {
        return [];
    }

    public function editorFields()
    {
        return [];
    }
}
