<?php

namespace LowB\Ladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use LowB\Ladmin\Contracts\Controllers\CrudControllerInterface;

class AbstractCrudController extends Controller implements CrudControllerInterface
{
    public function show(Request $request): View
    {
        return view('ladmin::crud.show');
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
