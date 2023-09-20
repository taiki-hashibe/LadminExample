<?php

namespace LowB\Ladmin\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
use LowB\Ladmin\Config\Facades\LadminConfig;
use LowB\Ladmin\Facades\Ladmin;

class CrudController extends AbstractCrudController
{
    public function show(Request $request): View
    {
        $fields = $this->showFields();
        $items = Ladmin::query()->paginate($this->paginate);
        return FacadesView::first($this->generateViewPriority('show'), [
            'items' => $items,
            'fields' => $fields
        ]);
    }

    public function detail(Request $request): View
    {
        $fields = $this->detailFields();
        if (!Ladmin::currentItem()) {
            abort(404);
        }
        return FacadesView::first($this->generateViewPriority('detail'), [
            'fields' => $fields,
        ]);
    }

    public function editor(Request $request): View
    {
        $fields = $this->editorFields();
        if (!Ladmin::currentItem()) {
            abort(404);
        }
        return FacadesView::first($this->generateViewPriority('editor'), [
            'fields' => $fields,
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate($this->validationRules());
        Ladmin::query()->create($this->getRequestValues($request));
        return redirect()->route(Ladmin::crud()->detail()->create()->routeName(), [
            'primaryKey' => Ladmin::currentPrimaryKey()
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate($this->validationRules());
        Ladmin::currentItemUpdate($this->getRequestValues($request));
        return redirect()->route(Ladmin::crud()->detail()->routeName(), [
            'primaryKey' => Ladmin::currentPrimaryKey()
        ]);;
    }

    public function destroy(Request $request): RedirectResponse
    {
        Ladmin::itemDelete($request->primaryKey);
        return redirect()->route(Ladmin::crud()->show()->routeName());
    }

    protected function generateViewPriority(string $method): array
    {
        return [LadminConfig::localViewPrefix() . Ladmin::crud()->tableName() . '.' . $method, LadminConfig::localViewPrefix() . 'crud.' . $method, LadminConfig::theme() . 'crud.' . $method];
    }
}
