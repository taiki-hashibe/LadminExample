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
    public function show(Request $request)
    {
        return view('ladmin::crud.show', [
            'fields' => $this->showFields()
        ]);
    }

    public function detail(Request $request)
    {
        return view('ladmin::crud.detail', [
            'fields' => $this->detailFields()
        ]);
    }

    public function edit(Request $request)
    {
        return view('ladmin::crud.edit', [
            'fields' => $this->editFields()
        ]);
    }

    public function create(Request $request)
    {
        dump('create');
    }

    public function update(Request $request)
    {
        dump('update');
    }

    public function destroy(Request $request)
    {
        dump('destroy');
    }

    protected function generateViewPriority(string $method): array
    {
        return [LadminConfig::localViewPrefix() . Ladmin::crud()->tableName() . '.' . $method, LadminConfig::localViewPrefix() . 'crud.' . $method, LadminConfig::theme() . 'crud.' . $method];
    }
}
