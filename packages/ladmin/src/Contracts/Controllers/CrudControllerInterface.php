<?php

namespace LowB\Ladmin\Contracts\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface CrudControllerInterface
{
    public function show(Request $request): View;

    public function detail(Request $request): View;

    public function editor(Request $request): View;

    public function create(Request $request): RedirectResponse;

    public function update(Request $request): RedirectResponse;

    public function destroy(Request $request): RedirectResponse;
}
