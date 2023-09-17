<?php

namespace LowB\Ladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use LowB\Ladmin\Contracts\Controllers\CrudControllerInterface;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Support\Facades\LadminRoute;

class AbstractCrudController extends Controller implements CrudControllerInterface
{
    public Crud|null $crud = null;
    public mixed $primaryKey = 'id';
    public int $paginate = 24;

    public function init(Crud $crud)
    {
        $this->crud = $crud;
        $this->primaryKey = $crud->getModel()->getKeyName();
    }

    public function show(Request $request): View
    {
        $instance = $this->crud->getModel();
        $columns = $this->crud->getColumns();
        $items = $instance->paginate($this->paginate);
        return view('ladmin::crud.show', [
            'crud' => $this->crud,
            'columns' => $columns,
            'items' => $items
        ]);
    }

    public function detail(Request $request): View
    {
        return view('ladmin::crud.detail');
    }

    public function editor(Request $request): View
    {
        return view('ladmin::crud.editor');
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
        return redirect('/');
    }
}
