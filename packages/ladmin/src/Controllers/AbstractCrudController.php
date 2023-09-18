<?php

namespace LowB\Ladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use LowB\Ladmin\Contracts\Controllers\CrudControllerInterface;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\GenerateFields;
use LowB\Ladmin\Support\Facades\GenerateValidationRules;

class AbstractCrudController extends Controller implements CrudControllerInterface
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

    public function show(Request $request): View
    {
        $fields = $this->showFields();
        $items = $this->crud->getQuery()->paginate($this->paginate);
        return view('ladmin::crud.show', [
            'items' => $items,
            'fields' => $fields
        ]);
    }

    public function detailFields()
    {
        return GenerateFields::detail($this->crud);
    }

    public function detail(Request $request): View
    {
        $fields = $this->detailFields();
        $item = $this->crud->getQuery()->where($this->crud->getPrimaryKey(), $request->primaryKey)->first();
        if (!$item) {
            abort(404);
        }
        return view('ladmin::crud.detail', [
            'fields' => $fields,
            'item' => $item
        ]);
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

    public function editor(Request $request): View
    {
        $fields = $this->editorFields();
        $item = $this->crud->getQuery()->where($this->crud->getPrimaryKey(), $request->primaryKey)->first();
        if (!$item) {
            abort(404);
        }
        return view('ladmin::crud.editor', [
            'fields' => $fields,
            'item' => $item
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        return redirect('/');
    }

    public function update(Request $request): RedirectResponse
    {
        return redirect('/');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $item = $this->crud->getQuery()->where($this->crud->getPrimaryKey(), $request->primaryKey)->first();
        $item->delete();
        return redirect()->route(Ladmin::crud()->getShowRouteName());
    }
}
