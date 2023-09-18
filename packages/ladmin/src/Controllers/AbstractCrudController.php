<?php

namespace LowB\Ladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Support\Facades\GenerateFields;

class AbstractCrudController extends Controller
{
    public Crud|null $crud = null;
    public int $paginate = 24;

    public function init(Crud $crud)
    {
        $this->crud = $crud;
    }

    public function showFields()
    {
        return GenerateFields::show($this->crud);
    }

    public function detailFields()
    {
        return GenerateFields::detail($this->crud);
    }

    public function editorFields()
    {
        return GenerateFields::editor($this->crud);
    }

    protected function validationRules(): array
    {
        $validations = [];
        $editorFields = $this->editorFields();
        foreach ($editorFields as $field) {
            $validations[$field->getName()] = $field->getValidation();
        }
        return $validations;
    }

    protected function getRequestValues(Request $request): array
    {
        $values = [];
        $editorFields = $this->editorFields();
        foreach ($editorFields as $field) {
            $values[$field->getName()] = $request->{$field->getName()};
        }
        return $values;
    }
}
