<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PortfolioItem;
use App\Http\Controllers\Controller;
use App\DataTables\PortfolioItemDataTable;

class PortfolioItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PortfolioItemDataTable $dataTable)
    {
        return $dataTable->render('admin.portfolio-item.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.portfolio-item.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'image' => ['required','image', 'max:5000'],
            'title' => ['required', 'max:200'],
            'category_id' => ['required','numeric'],
            'description' => ['required', 'max:500'],
            'client' => ['max:200'],
            'website' => ['url'],
        ]);

        $imagePath = handleUpload('image');
        $create = new PortfolioItem;

        $create->image =  $imagePath;
        $create->title =  $request->title;
        $create->category_id =  $request->category_id;
        $create->description =  $request->description;
        $create->client =  $request->client;
        $create->website =  $request->website;

        $create->save();
        toastr()->success('Created successfully!', 'Congrats');
        return redirect()->route('admin.portfolio-item.index');
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
        $category = Category::all();
        $portfolio = PortfolioItem::findOrFail($id);
        return view('admin.portfolio-item.edit', compact('portfolio','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['image', 'max:5000'],
            'title' => ['required', 'max:200'],
            'category_id' => ['required','numeric'],
            'description' => ['required', 'max:500'],
            'client' => ['max:200'],
            'website' => ['url'],
        ]);

        $imagePath = handleUpload('image');
        $update = PortfolioItem::findOrFail($id);

        $update->image =  $imagePath;
        $update->title =  $request->title;
        $update->category_id =  $request->category_id;
        $update->description =  $request->description;
        $update->client =  $request->client;
        $update->website =  $request->website;

        $update->save();
        toastr()->success('Created successfully!', 'Congrats');
        return redirect()->route('admin.portfolio-item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio = PortfolioItem::findOrFail($id);
        deleteFileIfExist($portfolio->image);
        $portfolio->delete();
    }
}
