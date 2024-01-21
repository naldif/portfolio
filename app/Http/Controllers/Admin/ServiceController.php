<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\DataTables\ServiceDataTable;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ServiceDataTable $dataTable)
    {
        return $dataTable->render('admin.service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'description' => ['required', 'max:500']
        ]);

        $create = new Service();
        $create->name = $request->name;
        $create->description = $request->description;
        $create->save();

        toastr()->success('Created successfully!', 'Congrats');
        return redirect()->route('admin.service.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('admin.service.edit', compact('service'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'description' => ['required', 'max:500']
        ]);

        $edit = Service::findOrFail($id);
        $edit->name = $request->name;
        $edit->description = $request->description;
        $edit->save();

        toastr()->success('Updated successfully!', 'Congrats');
        return redirect()->route('admin.service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Service::findOrFail($id);
        $data->delete();
    }
}
