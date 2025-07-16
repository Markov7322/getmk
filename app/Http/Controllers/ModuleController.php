<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('course')->get();
        return Inertia::render('Modules/Index', [
            'modules' => $modules,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Module::class);
        return Inertia::render('Modules/Create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Module::class);
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
        ]);
        $module = Module::create($data);
        return redirect()->route('modules.show', $module);
    }

    public function show(Module $module)
    {
        $this->authorize('view', $module);
        return Inertia::render('Modules/Show', [
            'module' => $module->load('lessons'),
        ]);
    }

    public function edit(Module $module)
    {
        $this->authorize('update', $module);
        return Inertia::render('Modules/Edit', [
            'module' => $module,
        ]);
    }

    public function update(Request $request, Module $module)
    {
        $this->authorize('update', $module);
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $module->update($data);
        return redirect()->route('modules.show', $module);
    }

    public function destroy(Module $module)
    {
        $this->authorize('delete', $module);
        $module->delete();
        return redirect()->back();
    }
}
