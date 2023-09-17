<?php

namespace LowB\Ladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use LowB\Ladmin\Contracts\Controllers\CrudControllerInterface;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;

class AbstractCrudController extends Controller implements CrudControllerInterface
{
    public Crud|null $crud = null;
    public int $paginate = 24;

    public function init(Crud $crud)
    {
        $this->crud = $crud;
    }

    public function show(Request $request): View
    {
        $items = $this->crud->getQuery()->paginate($this->paginate);
        return view('ladmin::crud.show', [
            'items' => $items
        ]);
    }

    public function detail(Request $request): View
    {
        $item = $this->crud->getQuery()->where($this->crud->getPrimaryKey(), $request->primaryKey)->first();
        if (!$item) {
            abort(404);
        }
        return view('ladmin::crud.detail', [
            'item' => $item
        ]);
    }

    public function editor(Request $request): View
    {
        $item = $this->crud->getQuery()->where($this->crud->getPrimaryKey(), $request->primaryKey)->first();
        if (!$item) {
            abort(404);
        }
        return view('ladmin::crud.editor', [
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
