<?php

namespace Modules\Items\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Category\Models\Category;
use Modules\CategoryGroup\Models\CategoryGroup;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categoryGroup = CategoryGroup::all();
        $category = Category::all();
        $unit = [
            (object) ['id' => 1,'nama' => 'Pcs'], (object) ['id' => 2,'nama' => 'Kg'],
            (object) ['id' => 3,'nama' => 'Potong'], (object) ['id' => 4,'nama' => 'Kilo'],
            (object) ['id' => 5,'nama' => 'Lusin'], (object) ['id' => 6,'nama' => 'Kilogram'],
            (object) ['id' => 7,'nama' => 'Paket'], (object) ['id' => 8,'nama' => 'Dus'],
            (object) ['id' => 9,'nama' => 'Karton'], (object) ['id' => 10,'nama' => 'Meter'],
            (object) ['id' => 11,'nama' => 'Liter'], (object) ['id' => 12,'nama' => 'Botol'],
            (object) ['id' => 13,'nama' => 'Buah'], (object) ['id' => 14,'nama' => 'Galon'],
        ];
        return view('items::index', compact('category', 'unit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('items::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('items::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
