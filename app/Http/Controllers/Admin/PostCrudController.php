<?php

namespace App\Http\Controllers\Admin;

use LowB\Ladmin\Controllers\CrudController as BaseCrudController;

class PostCrudController extends BaseCrudController
{
    public function showFields()
    {
        return [];
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
