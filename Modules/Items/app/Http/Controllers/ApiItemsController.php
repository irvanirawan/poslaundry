<?php

namespace Modules\Items\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Modules\Category\Models\Category;
use Modules\CategoryGroup\Models\CategoryGroup;
use Modules\Items\Models\Items;

class ApiItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Items::with('createdByUser', 'updatedByUser', 'category', 'categoryGroup');

        if($request->has('status')) {
            $items->where('status', $request->input('status'));
        }

        if($request->has('count')) {
            $result = $items->count();
        } else {
            $result = $items->get();
        }

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'nullable|string|max:50',
            'nama' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:50',
            'kategori_id' => 'nullable|integer',
            'satuan' => 'nullable|string',
            'hargajual' => 'nullable|numeric',
            'hargamodal' => 'nullable|numeric',
            'stok' => 'nullable|numeric',
            'stokmin' => 'nullable|numeric',
            'stokmax' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|string',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();

        // if kategori_id is not null, check if it exists
        if ($request->has('kategori_id')) {
            $kategori = Category::find($request->input('kategori_id'));
            if (!$kategori) {
                return response()->json(['message' => 'Kategori not found'], 404);
            }else{
                $validatedData['kategori_id'] = $kategori->id;
                $validatedData['kelompok_id'] = $kategori->categoryGroup->id ?? null;
            }
        }

        $items = Items::create($validatedData);
        return response()->json($items, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $items = Items::find($id);
        if (!$items) {
            return response()->json(['message' => 'Items not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'kode' => 'nullable|string|max:50',
            'nama' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:50',
            'kategori_id' => 'nullable|integer',
            'satuan' => 'nullable|string',
            'hargajual' => 'nullable|numeric',
            'hargamodal' => 'nullable|numeric',
            'stok' => 'nullable|numeric',
            'stokmin' => 'nullable|numeric',
            'stokmax' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|string',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();

        // if kategori_id is not null, check if it exists
        if ($request->has('kategori_id')) {
            $kategori = Category::find($request->input('kategori_id'));
            if (!$kategori) {
                return response()->json(['message' => 'Kategori not found'], 404);
            }else{
                $validatedData['kategori_id'] = $kategori->id;
                $validatedData['kelompok_id'] = $kategori->categoryGroup->id ?? null;
            }
        }

        $items->update($validatedData);
        return response()->json($items, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $items = Items::find($id);
        if (!$items) {
            return response()->json(['message' => 'Items not found'], 404);
        }

        $items->delete();
        return response()->json(['message' => 'Items deleted'], 200);
    }
}
