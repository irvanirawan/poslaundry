<?php

namespace Modules\CategoryGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Modules\CategoryGroup\Models\CategoryGroup;

class ApiCategoryGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryGroup = CategoryGroup::with('createdByUser', 'updatedByUser');

        if($request->has('status')) {
            $categoryGroup->where('status', $request->input('status'));
        }

        if($request->has('count')) {
            $result = $categoryGroup->count();
        } else {
            $result = $categoryGroup->get();
        }

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'nullable|string|max:10',
            'nama' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();
        $categoryGroup = CategoryGroup::create($validatedData);
        return response()->json($categoryGroup, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoryGroup = CategoryGroup::find($id);
        if (!$categoryGroup) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'kode' => 'nullable|string|max:10',
            'nama' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();
        $categoryGroup->update($validatedData);

        return response()->json($categoryGroup, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = CategoryGroup::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $data->delete();
        return response()->json(['message' => 'Data deleted'], 200);
    }
}
